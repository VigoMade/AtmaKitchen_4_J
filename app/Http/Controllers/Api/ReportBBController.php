<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PemakaianBB;
use Carbon\Carbon;
use Exception;

class ReportBBController extends Controller
{
    public function index($periodeAwal, $periodeAkhir)
    {
        try {
            // Validate the dates
            $startDate = Carbon::parse($periodeAwal)->startOfDay();
            $endDate = Carbon::parse($periodeAkhir)->endOfDay();

            // Filter PemakaianBB records based on the provided date range
            $pemakaian = PemakaianBB::with('bahanBaku')
                ->whereBetween('tanggal_pemakaian', [$startDate, $endDate])
                ->get();

            if ($pemakaian->isNotEmpty()) {
                // Map each PemakaianBB instance to the desired format
                $pemakaianData = $pemakaian->map(function ($item) {
                    return [
                        'id_pemakaian' => $item->id_pemakaian ?? 0,
                        'id_bb' => $item->id_bb ?? 0,
                        'tanggal_pemakaian' => $item->tanggal_pemakaian ?? null,
                        'total_pemakaian' => $item->total_pemakaian ?? 0,
                        'nama_bahan_baku' => $item->bahanBaku->nama_bahan_baku ?? null,
                        'satuan_bahan_baku' => $item->bahanBaku->satuan_bahan_baku ?? null,
                    ];
                });

                return response()->json([
                    'message' => 'Retrieve All Success',
                    'data' => $pemakaianData,
                ], 200);
            }

            return response()->json([
                'message' => 'Empty',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch data: ' . $e->getMessage()
            ], 500);
        }
    }
}
