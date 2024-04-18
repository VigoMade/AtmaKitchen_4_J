<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetMail;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function reset($email)
    {
        $user = Customer::where('email', $email)->first();
        if ($user) {
            Session::flash('message', 'Link Verifikasi telah dikirim ke email anda. Silahkan Cek email anda untuk mengaktifkan akun');
            return view('resetPasswordPage', compact('user'));
        } else {
            return redirect()->route('lupaPassword')->with('error', 'Email tidak ditemukan');
        }
    }


    public function actionReset(Request $request)
    {
        $email = $request->input('email');
        $user = Customer::where('email', $email)->first();
        if ($user->active != 1) {
            return redirect('lupaPassword')->with('error', 'Email belum terverifikasi');
        } else {
            if ($user) {
                $str = Str::random(100);
                $user->update([
                    'verify_key' => $str,
                ]);

                $details = [
                    'username' => $user->username,
                    'website' => 'Atma Kitchen',
                    'datetime' => date('Y-m-d H:i:s'),
                    'url' => request()->getHttpHost() . '/reset/' . $user->email . '/' . $str
                ];

                Mail::to($user->email)->send(new ResetMail($details));

                Session::flash('message', 'Link Reset Password telah dikirim ke email anda. Silahkan Cek email anda untuk mereset password');
                return redirect('lupaPassword');
            } else {
                return redirect('lupaPassword')->with('error', 'Email tidak ditemukan');
            }
        }
    }


    public function gotoResetPassword($email, $verify_key)
    {
        $user = Customer::where('email', $email)->where('verify_key', $verify_key)->first();
        if ($user) {

            return view('resetPasswordPage', compact('user'));
        } else {

            return redirect()->route('lupaPassword')->with('error', 'Email atau kunci verifikasi tidak valid.');
        }
    }

    public function update(Request $request, $email)
    {
        $user = Customer::where('email', $email)->first();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect('login')->with(['message' => 'Password berhasil direset. Silahkan login dengan password baru anda.']);
    }
}
