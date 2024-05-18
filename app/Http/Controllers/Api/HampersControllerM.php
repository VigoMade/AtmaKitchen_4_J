<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Hampers;
use Exception;
use Illuminate\Http\Request;

class HampersControllerM extends Controller{

    public function getHampers()
    {
        try {
            // Mengambil produk dengan jenis produk tertentu dan memuat data penitip terkait
            $hampers = Hampers::all();
            // Memformat data produk
            $formattedProduks = $hampers->map(function ($hamper) {
                    return [
                       'id_hampers' => $hamper->id_hampers,
                       'harga_hampers' => $hamper->harga_hampers,
                       'deskripsi_hampers' => $hamper->deskripsi_hampers,
                       'nama_hampers' => $hamper->nama_hampers,
                       'image' => $hamper->image, 
                    ];
            });

            // Mengembalikan response JSON
            return response([
                'message' => 'Retrieve All Success',
                'data' => $formattedProduks,
            ], 200);

        } catch (Exception $e) {
            // Menangani pengecualian dan mengembalikan response error
            return response([
                'message' => 'Retrieve Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}