<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class StockReportController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua data bahan baku yang memiliki stok tersedia lebih dari 0
            $bahanBaku = BahanBaku::where('takaran_bahan_baku_tersedia', '>', 0)->get();

            return response()->json([
                'success' => true,
                'data' => $bahanBaku,
                'message' => 'Data stok bahan baku yang tersedia berhasil diambil.'
            ], 200);
        } catch (Exception $e) {
            // Tangani pengecualian jika terjadi
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data stok bahan baku yang tersedia: ' . $e->getMessage(),
            ], 500);
        }
    }
}
