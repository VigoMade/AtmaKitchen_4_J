<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        return view('Customer.profileCustomer', compact('user'));
    }

    public function edit($id)
    {
        $user = Customer::find($id);
        return view('Customer.editProfileCustomer', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Customer::find($id);
        $this->validate($request, [
            'username'  => 'required',
            'nama' => 'required',
            'email' => 'required',
            'noTelpon' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $fotoProduk = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fotoProduk);
            $input['image'] = $fotoProduk;
        } else {
            unset($input['image']);
        }

        try {
            $user->update($input);
            return redirect()->route('customer.index')->with('success', 'Data berhasil diubah');
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }
}
