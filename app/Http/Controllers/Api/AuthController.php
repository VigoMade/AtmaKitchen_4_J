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
}
