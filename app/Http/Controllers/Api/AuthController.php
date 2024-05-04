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
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 422);
        }

        if (auth()->guard('customer')->attempt($loginData)) {
            /** @var \App\Models\Customer $customer **/
            $customer = auth()->guard('customer')->user();
            $token = $customer->createToken('Authentication Token')->accessToken;

            return response([
                'message' => 'Authenticated',
                'customer' => $customer,
                'token_type' => 'Bearer',
                'access_token' => $token
            ]);
        } else if (auth()->guard('pegawai')->attempt($loginData)) {
            /** @var \App\Models\Pegawai $pegawai **/
            $pegawai = auth()->guard('pegawai')->user();
            $token = $pegawai->createToken('Authentication Token')->accessToken;

            return response([
                'message' => 'Authenticated',
                'customer' => $pegawai,
                'token_type' => 'Bearer',
                'access_token' => $token
            ]);
        } else {
            return response(['message' => 'Invalid credentials'], 422);
        }
    }


    public function login_role(Request $request)
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
            switch ($pegawai->role) {
                case 'Owner':
                    return response()->json([
                        'message' => 'Authenticated as Owner',
                        'user' => $pegawai,
                        'token' => $token,
                    ]);
                    break;
                case 'Admin':
                    return response()->json([
                        'message' => 'Authenticated as Admin',
                        'user' => $pegawai,
                        'token' => $token,
                    ]);
                    break;
                case 'MO':
                    return response()->json([
                        'message' => 'Authenticated as MO',
                        'user' => $pegawai,
                        'token' => $token,
                    ]);
                    break;
                default:
                    return response()->json(['message' => 'Unauthorized'], 401);
                    break;
            }
        }

        // Lakukan autentikasi customer
        if (auth()->guard('customer')->attempt($credentials)) {
            $customer = auth()->guard('customer')->user();
            $token = $customer->createToken('Personal Access Token')->accessToken;
            
            // Tentukan respons sesuai peran customer
            return response()->json([
                'message' => 'Authenticated as Customer',
                'user' => $customer,
                'token' => $token,
            ]);
        }

        // Jika autentikasi gagal, kembalikan respon Unauthorized
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
