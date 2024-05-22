<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::whereNotNull('id_transaksi_fk')->paginate(5);
        return view('MoOwnerPemasukan.indexPemasukan', compact('pemasukan'));
    }
}
