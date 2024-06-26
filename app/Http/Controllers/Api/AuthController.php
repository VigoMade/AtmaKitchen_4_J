<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Pegawai;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Validasi data masukan
        $validator = Validator::make($credentials, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Jika validasi gagal, kembalikan respon dengan status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        // Lakukan autentikasi pegawai
        if (auth()->guard('pegawai')->attempt($credentials)) {
            $pegawai = auth()->guard('pegawai')->user();

            $token = $pegawai->createToken('Personal Access Token')->accessToken;

            // Cek peran pegawai
            switch ($pegawai->jabatan->role) {
                case 'Admin':
                    return response()->json([
                        'message' => 'Berhasil terautentikasi sebagai Pemilik',
                        'user' => $pegawai,
                        'id_customer' => $pegawai->id_pegawai,
                        'role' => $pegawai->jabatan->role,
                        'email' => $pegawai->email_pegawai,
                        'noTelpon' => $pegawai->telepon_pegawai,
                        'nama' => $pegawai->nama_pegawai,
                        'image' => $pegawai->foto,
                        'token' => $token,
                    ]);
                    break;
                case 'Owner':
                    return response()->json([
                        'message' => 'Berhasil terautentikasi sebagai Admin',
                        'user' => $pegawai,
                        'id_customer' => $pegawai->id_pegawai,
                        'role' => $pegawai->jabatan->role,
                        'email' => $pegawai->email_pegawai,
                        'noTelpon' => $pegawai->telepon_pegawai,
                        'nama' => $pegawai->nama_pegawai,
                        'image' => $pegawai->foto,
                        'token' => $token,
                    ]);
                    break;
                case 'MO':
                    return response()->json([
                        'message' => 'Berhasil terautentikasi sebagai MO',
                        'user' => $pegawai,
                        'id_customer' => $pegawai->id_pegawai,
                        'role' => $pegawai->jabatan->role,
                        'email' => $pegawai->email_pegawai,
                        'noTelpon' => $pegawai->telepon_pegawai,
                        'nama' => $pegawai->nama_pegawai,
                        'image' => $pegawai->foto,
                        'token' => $token,
                    ]);
                    break;
                default:
                    return response()->json(['message' => 'Tidak diizinkan'], 401);
                    break;
            }
        }

        // Lakukan autentikasi pelanggan
        if (auth()->guard('customer')->attempt($credentials)) {
            $customer = auth()->guard('customer')->user();
            $token = $customer->createToken('Personal Access Token')->accessToken;
            if ($request->has('device_key')) {
                $deviceKey = $request->input('device_key');
                $customer->device_key = $deviceKey;
                $customer->save();
                
            }
            // Tentukan respons sesuai peran pelanggan
            return response()->json([
                'message' => 'Berhasil terautentikasi sebagai Pelanggan',
                'user' => $customer,
                'id_customer' => $customer->id_customer,
                'role' => 'Customer',
                'email' => $customer->email,
                'noTelpon' => $customer->noTelpon,
                'token' => $token,
                'nama' => $customer->nama,
                'image' => $customer->image ? $customer->image : "",
                'point_customer' => $customer->point_customer ?? 0,
                'saldo_customer' => $customer->saldo_customer ?? 0
            ]);
        }

        // Jika autentikasi gagal, kembalikan respon Unauthorized
        return response()->json(['message' => 'Tidak diizinkan'], 401);
    }
}
