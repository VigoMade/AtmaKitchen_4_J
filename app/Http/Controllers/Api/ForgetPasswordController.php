<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetMail;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $email = $request->input('email');
        $user = Customer::where('email', $email)->first();

        if ($user) {
            if ($user->active != 1) {
                return response()->json(['error' => 'Email belum terverifikasi'], 400);
            }

            $str = Str::random(100);
            $user->update(['verify_key' => $str]);
            $baseUrl = 'http://127.0.0.1:8000/';

            $details = [
                'username' => $user->username,
                'website' => 'Atma Kitchen',
                'datetime' => now()->toDateTimeString(),
                'url' => $baseUrl . 'reset/' . $user->email . '/' . $str
            ];

            Mail::to($user->email)->send(new ResetMail($details));

            return response()->json(['message' => 'Link Reset Password telah dikirim ke email anda. Silahkan cek email anda untuk mereset password'], 200);
        } else {
            return response()->json(['error' => 'Email tidak ditemukan'], 404);
        }
    }

    public function gotoResetPassword($email, $verify_key)
    {
        $user = Customer::where('email', $email)->where('verify_key', $verify_key)->first();
        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'Email atau kunci verifikasi tidak valid'], 400);
        }
    }
}
