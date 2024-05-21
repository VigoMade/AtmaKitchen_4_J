<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penitip;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $produks = Produk::where('jenis_produk', $title)
            ->orWhereHas('penitips', function($query) use ($title) {
                $query->where('jenis_produk_penitip', $title);
            })
            ->with('penitips')
            ->get();
        
            

            // Memformat data produk
            $formattedProduks = $produks->map(function ($produk) {
                // Jika produk memiliki penitip
                if ($produk->id_penitip) {
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->penitips->nama_produk_penitip ?? "",
                        'jenis_produk' => $produk->penitips->jenis_produk_penitip ?? "",
                        'harga_produk' => $produk->harga_produk ?? 0,
                        'satuan_produk' => $produk->satuan_produk ?? "",
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status ?? "",
                        'image' => $produk->penitips->image ?? "",
                        'tipe_produk' => $produk->tipe_produk ?? "",
                    ];
                } else {
                    // Jika produk tidak memiliki penitip
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->nama_produk ?? "",
                        'jenis_produk' => $produk->jenis_produk ?? "",
                        'harga_produk' => $produk->harga_produk ?? 0,
                        'satuan_produk' => $produk->satuan_produk ?? "",
                        'stock_produk' => $produk->kuota ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ? $produk->tanggal_mulai_po : null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ? $produk->tanggal_selesai_po : null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status ?? "" ,
                        'image' => $produk->image ?? "",
                        'tipe_produk' => $produk->tipe_produk ?? "",
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

    public function getProdukbyid($id)
    {
        try {
            // Mengambil produk dengan jenis produk tertentu dan memuat data penitip terkait
            $produk = Produk::with('penitips')->where('id_produk', $id)->get();
            $formattedProduks = $produk->map(function ($produk) {
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
                        'tipe_produk' => $produk->tipe_produk ?? "",
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

    public function getSpecialProduk()
{
    try {
        // Retrieve top 5 most frequently purchased products
        $transaksi = Transaksi::select('id_produk_fk', 'id_penitip_fk', DB::raw('COUNT(*) as purchase_count'))
        ->groupBy('id_produk_fk', 'id_penitip_fk')
        ->orderByDesc('purchase_count')
        ->with(['produk', 'penitip'])  // Eager load the product and penitip relationship
        ->limit(5)  // Limit the results to the top 5
        ->get();    
        // Check if $transaksi is empty
        if ($transaksi->isEmpty()) {
            // No products found
            return response()->json([
                'message' => 'No products found',
            ], 404);
        } else {
            // Format the products data
            $formattedProduks = $transaksi->map(function ($trans) {
                $produk = $trans->produk;
                $penitip = $trans->penitip;

                if ($penitip) {
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $penitip->nama_produk_penitip ?? '',
                        'jenis_produk' => $produk->jenis_produk ?? '',
                        'harga_produk' => $produk->harga_produk ?? 0,
                        'satuan_produk' => $produk->satuan_produk ?? '',
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ?? null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ?? null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status ?? '',
                        'image' => $penitip->image ?? '',
                        'tipe_produk' => $produk->tipe_produk ?? '',
                    ];
                } else {
                    // If product does not have penitip
                    return [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->nama_produk ?? '',
                        'jenis_produk' => $produk->jenis_produk ?? '',
                        'harga_produk' => $produk->harga_produk ?? 0,
                        'satuan_produk' => $produk->satuan_produk ?? '',
                        'stock_produk' => $produk->stock_produk ?? 0,
                        'tanggal_mulai_po' => $produk->tanggal_mulai_po ?? null,
                        'tanggal_selesai_po' => $produk->tanggal_selesai_po ?? null,
                        'kuota' => $produk->kuota ?? 0,
                        'id_penitip' => $produk->id_penitip,
                        'id_resep' => $produk->id_resep,
                        'status' => $produk->status ?? '',
                        'image' => $produk->image ?? '',
                        'tipe_produk' => $produk->tipe_produk ?? '',
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


}
