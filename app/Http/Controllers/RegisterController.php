<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function actionRegister(Request $request)
    {
        $str = Str::random(100);
        $user = Customer::create([
            'email' => $request->email,
            'noTelpon' => $request->noTelpon,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'verify_key' => $str,
        ]);

        $details = [
            'username' => $request->username,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];

        Mail::to($request->email)->send(new MailSend($details));
        Session::flash('message', 'Link Verifikasi telah dikirim ke email anda. Silahkan Cek email anda untuk mengaktifkan akun');
        return redirect('register');
    }

    public function verify($verify_key)
    {
        $keyCheck = Customer::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();
        if ($keyCheck) {
            $user = Customer::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]);

            return "Verifikasi Berhasil. Akun Anda sudah aktif.";
        } else {
            return 'Keys tidak valid';
        }
    }
}
