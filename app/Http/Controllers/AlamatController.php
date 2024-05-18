<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::Where('id_customer', $user->id_customer)->get();
        return view('Transaksi.indexAlamat', compact('alamat', 'user'));
    }

    public function destroy($id)
    {
        $alamat = Alamat::find($id);
        $alamat->delete();
        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil dihapus']);
    }
}
