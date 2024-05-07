<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Penitip;
use App\Models\Produk;
use App\Models\Resep;
use Exception; // Pastikan menggunakan use Exception di atas namespace
use Illuminate\Http\Request;

class ProdukControllerM extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $produk = Produk::orderBy('id_produk', 'desc')->paginate(5);
        return view('AdminProduk.indexProduk', compact('produk'));
    }

    public function index_mobile()
    {
        $produk = Produk::all();
        return response([
            'message'=> 'Retrieve All Success',
            'data' => $produk,
            ],200);
    }

    public function getImage($filename)
    {
        $path = public_path('images/' . $filename);
        if (file_exists($path)) {
            // Jika gambar ada, kirimkan respons dengan file gambar
            return response()->file($path);
        } else {
            // Jika gambar tidak ditemukan, kirimkan respons 404
            abort(404);
        }
    }
}
