<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    public function create()
    {
        return view('Transaksi.createAlamat');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat_customer' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('customer')->user();
        Alamat::create([
            'alamat_customer' => $request->alamat_customer,
            'id_customer' => $user->id_customer,
            'alamat_aktif' => '0',
        ]);

        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil ditambahkan']);
    }

    public function index()
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::Where('id_customer', $user->id_customer)->paginate(2);
        return view('Transaksi.indexAlamat', compact('alamat', 'user'));
    }

    public function destroy($id)
    {
        $alamat = Alamat::find($id);
        $alamat->delete();
        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil dihapus']);
    }

    public function edit($id)
    {
        $alamat = Alamat::find($id);
        return view('Transaksi.editAlamat', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alamat_customer' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alamat = Alamat::find($id);
        $alamat->alamat_customer = $request->alamat_customer;
        $alamat->save();

        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil diperbarui']);
    }


    public function setAktif($id)
    {
        $alamat = Alamat::find($id);

        if ($alamat->alamat_aktif == 1) {
            $alamat->alamat_aktif = 0;
            $alamat->save();
            return redirect()->route('alamat.index')->with(['success' => 'Alamat Di Nonaktifkan']);
        } else {
            $userId = $alamat->id_customer;
            $alamatLainAktif = Alamat::where('id_customer', $userId)->where('alamat_aktif', 1)->first();
            if ($alamatLainAktif) {
                return redirect()->route('alamat.index')->with(['error' => 'Hanya satu alamat yang boleh aktif']);
            }
            $alamat->alamat_aktif = 1;
            $alamat->save();
            return redirect()->route('alamat.index')->with(['success' => 'Berhasil Set Alamat']);
        }
    }

    public function show(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('alamat_customer', 'LIKE', '%' . $request->search . '%')
            ->where('id_customer', $user->id_customer)
            ->get();
        if ($alamat->isEmpty()) {
            return redirect()->route('alamat.index')->with(['error' => 'Alamat tidak ditemukan']);
        } else {
            return view('Transaksi.indexAlamat', compact('alamat', 'user'));
        }
    }
}
