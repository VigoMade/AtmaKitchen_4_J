<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Perlu tambahkan ini untuk menggunakan Auth
use App\Models\Transaksi;
use App\Models\Penitip;
use App\Models\Produk;
use Illuminate\Http\Request;
use Exception;

class HistoriController extends Controller
{
    public function index($id)
    {
        $userId = Auth::guard('customer')->id();
        $transaksi = Transaksi::with('produk', 'penitip')
            ->where(function ($query) use ($id) {
                $query->where('id_customer', $id)
                    ->orWhere('id_pegawai', $id);
            })
            ->where(function ($query) {
                $query->where('status', 'Selesai')
                    ->orWhere('status', 'DiTolak');
            })
            ->get();
        if ($transaksi->isNotEmpty()) {
            $transaksiData = $transaksi->map(function ($item) {
                if ($item->id_penitip_fk) {
                    return [
                        'id_transaksi' => $item->id_transaksi,
                        'id_customer' => $item->id_customer,
                        'image' => $item->penitip->image ?? "",
                        'nama_produk' => $item->penitip->nama_produk_penitip ?? "",
                        'status' => $item->status,
                    ];
                } else {
                    return [
                        'id_transaksi' => $item->id_transaksi,
                        'id_customer' => $item->id_customer,
                        'image' => $item->produk->image ?? "",
                        'nama_produk' => $item->produk->nama_produk ?? "",
                        'status' => $item->status,
                    ];
                }
            });

            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksiData,
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function search(String $request)
    {
        $search = $request;

        if (!$search) {
            return response()->json([
                'error' => 'Query parameter is missing',
            ], 400);
        }

        try {
            $transactions = Transaksi::whereHas('produk', function ($query) use ($search) {
                $query->where('namaProduk', 'like', "%$search%");
            })->orWhereHas('produk.penitip', function ($query) use ($search) {
                $query->where('namaProdukPenitip', 'like', "%$search%");
            })->with('produk')->get();

            if ($transactions->isEmpty()) {
                return response()->json([
                    'message' => 'No matching records found',
                    'data' => [],
                ], 200);
            }

            $transaksiData = $transactions->map(function ($item) {
                return [
                    'id_transaksi' => $item->id_transaksi, // Assuming this is the correct field name for the transaction ID
                    'image' => $item->produk->image,
                    'status' => $item->status,
                    'nama_produk' => $item->produk->namaProduk,
                ];
            });

            return response()->json([
                'message' => 'Retrieve Success',
                'data' => $transaksiData,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
            ], 500);
        }
    }
}
