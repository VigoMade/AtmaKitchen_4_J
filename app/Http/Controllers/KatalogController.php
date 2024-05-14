<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function show($jenis_produk)
    {
        if ($jenis_produk === 'other') {

            $jenis = Produk::where(function ($query) {
                $query->whereNotIn('jenis_produk', ['bread', 'cake', 'drink'])
                    ->orWhereHas('penitips', function ($query) {
                        $query->whereNotIn('jenis_produk_penitip', ['bread', 'cake', 'drink']);
                    });
            })->get();
        } else {
            $jenis = Produk::where(function ($query) use ($jenis_produk) {
                $query->where('jenis_produk', 'like', "%" . $jenis_produk . "%")
                    ->orWhereHas('penitips', function ($query) use ($jenis_produk) {
                        $query->where('jenis_produk_penitip', 'like', "%" . $jenis_produk . "%");
                    });
            })->get();
        }

        return view('Katalog.informasiProduk', compact('jenis'));
    }
}
