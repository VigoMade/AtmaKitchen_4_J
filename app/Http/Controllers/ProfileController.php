<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        return view('Customer.profileCustomer', compact('user', 'alamat'));
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
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('images', $imageName, 'public');
            $input['image'] = $path;


            if ($user->image !== null && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
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
