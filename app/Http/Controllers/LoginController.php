<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('pegawai.index');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];
        if (Auth::guard('pegawai')->attempt($data)) {
            $pegawai = Auth::guard('pegawai')->user();
            if ($pegawai->active) {
                if ($pegawai->jabatan->role == "Owner") {
                    return redirect()->route('gaji.index');
                } else if ($pegawai->jabatan->role == "Admin") {
                    return redirect()->route('produks.index');
                } else if ($pegawai->jabatan->role == "MO") {
                    return redirect()->route('pegawai.index');
                }
            } else {
                Auth::guard('pegawai')->logout();
                Session::flash('error', 'Akun anda belum terverifikasi. Silahkan cek email anda.');
                return redirect('/');
            }
        } else if (Auth::guard('customer')->attempt($data)) {
            $user = Auth::guard('customer')->user();

            if ($user->active) {
                return redirect()->route('hampers.index');
            } else {
                Auth::guard('customer')->logout();
                Session::flash('error', 'Akun anda belum terverifikasi. Silahkan cek email anda.');
                return redirect('/');
            }
        } else {
            Session::flash('error', 'Username dan password salah');
            return redirect('/');
        }
    }



    public function actionLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}