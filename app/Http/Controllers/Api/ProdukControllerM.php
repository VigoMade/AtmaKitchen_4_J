<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Penitip;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;

class ProdukControllerM extends Controller
{
    /**
     * Mengambil produk berdasarkan jenis produk (title).
     *
     * @param string $title
     * @return \Illuminate\Http\Response
     */
    public function index_mobile($title)
    {
        try {
            // Mengambil produk dengan jenis produk tertentu dan memuat data penitip terkait
            $produks = Produk::with('penitips')->where('jenis_produk', $title)->get();

            // Memformat data produk
            $formattedProduks = $produks->map(function ($produk) {
                // Jika produk memiliki penitip
                if($produk->id_penitip){
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->penitips->nama_produk_penitip ?? "",
                        'jenis_produk' => $produk->jenis_produk,
                        'harga_produk' => $produk->harga_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status,
                        'image' => $produk->penitips->image ?? "",
                        'tipe_produk' => $produk->tipe_produk,
                    ];
                } else {
                    // Jika produk tidak memiliki penitip
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->nama_produk ?? "",
                        'jenis_produk' => $produk->jenis_produk,
                        'harga_produk' => $produk->harga_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status,
                        'image' => $produk->image ?? "",
                        'tipe_produk' => $produk->tipe_produk,
                    ];
                }
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

    public function getProdukbyid($id){
        try {
            // Mengambil produk dengan jenis produk tertentu dan memuat data penitip terkait
            $produks = Produk::with('penitips')->where('id_produk', $id)->get();
                // Jika produk memiliki penitip
                if($produk->id_penitip){
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->penitips->nama_produk_penitip ?? "",
                        'jenis_produk' => $produk->jenis_produk,
                        'harga_produk' => $produk->harga_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status,
                        'image' => $produk->penitips->image ?? "",
                        'tipe_produk' => $produk->tipe_produk,
                    ];
                } else {
                    // Jika produk tidak memiliki penitip
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->nama_produk ?? "",
                        'jenis_produk' => $produk->jenis_produk,
                        'harga_produk' => $produk->harga_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status,
                        'image' => $produk->image ?? "",
                        'tipe_produk' => $produk->tipe_produk,
                    ];
                }

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

    public function getSpecialProduk(){

        try {
            
            $produks = Produk::with('penitips')->get();
                
            // Check if $produks is empty
            if ($produks->isEmpty()) {
                // $produks kosong
                return response()->json([
                    'message' => 'No products found',
                ], 404);
            } else {
                // Format the products data
                $formattedProduks = $produks->map(function ($produk) {
                    if ($produk->id_penitip) {
                        return [
                            'id_produk' => $produk->id_produk,
                            'nama_produk' => $produk->penitips->nama_produk_penitip ?? "",
                            'jenis_produk' => $produk->jenis_produk,
                            'harga_produk' => $produk->harga_produk,
                            'satuan_produk' => $produk->satuan_produk,
                            'stock_produk' => $produk->stock_produk ?? 0,
                            'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                            'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                            'kuota' => $produk->kuota ?? 0,
                            'id_penitip' => $produk->id_penitip,
                            'id_resep' => $produk->id_resep,
                            'status' => $produk->status,
                            'image' => $produk->penitips->image ?? "",
                            'tipe_produk' => $produk->tipe_produk,
                        ];
                    } else {
                        return [
                            'id_produk' => $produk->id_produk,
                            'nama_produk' => $produk->nama_produk ?? "",
                            'jenis_produk' => $produk->jenis_produk,
                            'harga_produk' => $produk->harga_produk,
                            'satuan_produk' => $produk->satuan_produk,
                            'stock_produk' => $produk->stock_produk ?? 0,
                            'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                            'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                            'kuota' => $produk->kuota ?? 0,
                            'id_penitip' => $produk->id_penitip,
                            'id_resep' => $produk->id_resep,
                            'status' => $produk->status,
                            'image' => $produk->image ?? "",
                            'tipe_produk' => $produk->tipe_produk,
                        ];
                    }
                });
        
                // Return the response with formatted data
                return response()->json([
                    'message' => 'Retrieve All Success',
                    'data' => $formattedProduks,
                ], 200);
            }
        } catch (Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }

    // public function getSpecialProduk(){

    //     try {
    //         // Fetch top 5 products based on transaction count
    //         $produks = Transaksi::with(['produk.penitips', 'produk'])
    //             ->select('id_produk_fk', DB::raw('COUNT(*) as total_pembelian'))
    //             ->groupBy('id_produk_fk')
    //             ->orderByDesc('total_pembelian')
    //             ->take(5)
    //             ->get();
                
    //             dd($produks);
    //         // Check if $produks is empty
    //         if ($produks->isEmpty()) {
    //             // $produks kosong
    //             return response()->json([
    //                 'message' => 'No products found',
    //             ], 404);
    //         } else {
    //             // Format the products data
    //             $formattedProduks = $produks->map(function ($produk) {
    //                 if ($produk->produk->id_penitip) {
    //                     return [
    //                         'id_produk' => $produk->produk->id_produk,
    //                         'nama_produk' => $produk->produk->penitips->nama_produk_penitip ?? "",
    //                         'jenis_produk' => $produk->produk->jenis_produk,
    //                         'harga_produk' => $produk->produk->harga_produk,
    //                         'satuan_produk' => $produk->produk->satuan_produk,
    //                         'stock_produk' => $produk->produk->stock_produk ?? 0,
    //                         'tanggal_mulai_po' => $produk->produk->tanggal_mulai_po ? $produk->produk->tanggal_mulai_po : null,
    //                         'tanggal_selesai_po' => $produk->produk->tanggal_selesai_po ? $produk->produk->tanggal_selesai_po : null,
    //                         'kuota' => $produk->produk->kuota ?? 0,
    //                         'id_penitip' => $produk->produk->id_penitip,
    //                         'id_resep' => $produk->produk->id_resep,
    //                         'status' => $produk->produk->status,
    //                         'image' => $produk->produk->penitips->image ?? "",
    //                         'tipe_produk' => $produk->produk->tipe_produk,
    //                     ];
    //                 } else {
    //                     return [
    //                         'id_produk' => $produk->produk->id_produk,
    //                         'nama_produk' => $produk->produk->nama_produk ?? "",
    //                         'jenis_produk' => $produk->produk->jenis_produk,
    //                         'harga_produk' => $produk->produk->harga_produk,
    //                         'satuan_produk' => $produk->produk->satuan_produk,
    //                         'stock_produk' => $produk->produk->stock_produk ?? 0,
    //                         'tanggal_mulai_po' => $produk->produk->tanggal_mulai_po ? $produk->produk->tanggal_mulai_po : null,
    //                         'tanggal_selesai_po' => $produk->produk->tanggal_selesai_po ? $produk->produk->tanggal_selesai_po : null,
    //                         'kuota' => $produk->produk->kuota ?? 0,
    //                         'id_penitip' => $produk->produk->id_penitip,
    //                         'id_resep' => $produk->produk->id_resep,
    //                         'status' => $produk->produk->status,
    //                         'image' => $produk->produk->image ?? "",
    //                         'tipe_produk' => $produk->produk->tipe_produk,
    //                     ];
    //                 }
    //             });
        
    //             // Return the response with formatted data
    //             return response()->json([
    //                 'message' => 'Retrieve All Success',
    //                 'data' => $formattedProduks,
    //             ], 200);
    //         }
    //     } catch (Exception $e) {
    //         // Handle any errors
    //         return response()->json([
    //             'message' => 'An error occurred',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
        
    // }

}
