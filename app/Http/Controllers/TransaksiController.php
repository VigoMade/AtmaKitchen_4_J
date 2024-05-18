<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->select(
                't.jumlah_produk',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.status',
                DB::raw('COALESCE(p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )
            ->where('t.id_customer', $user->id_customer)
            ->where('t.status', 'Di Keranjang')
            ->get();

        return view('Transaksi.showAllTransaksi', compact('transaksi'));
    }
}
