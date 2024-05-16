<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
    public function show($jenis_produk)
    {
        $query = DB::table('produk')
            ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->select(
                DB::raw('COALESCE(produk.nama_produk, penitip.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip) AS jenis_produk'),
                'produk.harga_produk',
                'produk.id_produk',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            );
        if ($jenis_produk == 'other') {
            $jenis = $query->whereNotIn(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), ['drink', 'cake', 'bread'])->get();
        } else {
            $jenis = $query->where(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), $jenis_produk)->get();
        }


        return view('Katalog.informasiProduk', compact('jenis'));
    }

    public function showById($id_produk)
    {
        $produk = DB::table('produk')->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->select(
                DB::raw('COALESCE(produk.nama_produk, penitip.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip) AS jenis_produk'),
                'produk.harga_produk',
                'produk.id_produk',
                'produk.status',
                'produk.tanggal_mulai_po',
                'produk.tanggal_selesai_po',
                'produk.tipe_produk',
                'produk.satuan_produk',
                'produk.stock_produk',
                'produk.kuota',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            )->where('produk.id_produk', $id_produk)->first();

        return view('Katalog.detailProduk', compact('produk'));
    }
}
