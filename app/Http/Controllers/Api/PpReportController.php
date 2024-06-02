<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\PengeluaranLainnya;
use App\Models\PembelianBB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class PpReportController extends Controller
{
    public function getPP($bulan)
    {
        try {
            // Map month names to their respective numbers
            $months = [
                'january' => 1, 'januari' => 1,
                'february' => 2, 'februari' => 2,
                'march' => 3, 'maret' => 3,
                'april' => 4,
                'may' => 5, 'mei' => 5,
                'june' => 6, 'juni' => 6,
                'july' => 7, 'juli' => 7,
                'august' => 8, 'agustus' => 8,
                'september' => 9,
                'october' => 10, 'oktober' => 10,
                'november' => 11,
                'december' => 12, 'desember' => 12,
            ];

            // Convert month name to lowercase to handle case insensitivity
            $bulan = strtolower($bulan);

            // Validate and get the month number from the name
            if (!isset($months[$bulan])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid month name provided.',
                ], 400);
            }

            $monthNumber = $months[$bulan];
            $currentYear = Carbon::now()->year;

            // Get the start and end date for the specified month
            $startDate = Carbon::createFromDate($currentYear, $monthNumber, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($currentYear, $monthNumber, 1)->endOfMonth();

            // Fetch pemasukan (income) for the specified month based on tanggal_pembayaran from transaksi
            $pemasukan = Pemasukan::join('transaksi', 'pemasukan.id_transaksi_fk', '=', 'transaksi.id_transaksi')
            ->whereBetween('transaksi.tanggal_pembayaran', [$startDate, $endDate])
            ->select('pemasukan.id_pemasukan', 'pemasukan.total_pemasukan', 'pemasukan.tip')
            ->get();
          
            $totalPemasukan = $pemasukan->sum('total_pemasukan');
            $totalTip = $pemasukan->sum('tip');
            // Filter pemasukan to include only those that have a transaksi with tanggal_pembayaran in the date range
            $pemasukan = $pemasukan->filter(function ($item) {
                return $item->transaksi !== null;
            });

            // Fetch pengeluaran lainnya (other expenses) for the specified month
            $pengeluaranLainnya = PengeluaranLainnya::whereBetween('tanggal_pengeluaran_lainnya', [$startDate, $endDate])
                ->select('id_pengeluaran','nama_pengeluaran_lainnya', 'biaya_pengeluaran_lainnya')
                ->get();

            // Fetch pembelian bahan baku (raw material purchases) for the specified month
            $pembelianBB = PembelianBB::whereBetween('tanggal_pembelian', [$startDate, $endDate])
            ->select('id_pembelian', 'harga_bahan_baku', 'tanggal_pembelian', 'jumlah_bb_dibeli', 'id_bahan_baku')
            ->get();

            // Return the data in a JSON response
            // Return the data in a JSON response
        return response()->json([
            'success' => true,
            'data' => [
                'pemasukan' => [
                    'id_pemasukan' => 0,
                    'total_pemasukan' => $totalPemasukan ?? 0,
                    'tip' => $totalTip ?? 0,
                ],
                'pengeluaran' => $pengeluaranLainnya->map(function ($item) {
                    return [
                        'id_pengeluaran' => $item->id_pengeluaran,
                        'nama_pengeluaran_lainnya' => $item->nama_pengeluaran_lainnya,
                        'biaya_pengeluaran_lainnya' => $item->biaya_pengeluaran_lainnya ?? 0,
                    ];
                }),
                
            ],
            'message' => 'Monthly report generated successfully',
        ], 200);

        } catch (Exception $e) {
            // Handle exception
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate report: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function getBahanBaku($bulan)
    {
        try {
            // Map nama bulan ke nomor bulan
            $months = [
                'january' => 1, 'januari' => 1,
                'february' => 2, 'februari' => 2,
                'march' => 3, 'maret' => 3,
                'april' => 4,
                'may' => 5, 'mei' => 5,
                'june' => 6, 'juni' => 6,
                'july' => 7, 'juli' => 7,
                'august' => 8, 'agustus' => 8,
                'september' => 9,
                'october' => 10, 'oktober' => 10,
                'november' => 11,
                'december' => 12, 'desember' => 12,
            ];

            // Ubah nama bulan menjadi huruf kecil untuk penanganan case insensitivity
            $bulan = strtolower($bulan);

            // Validasi dan dapatkan nomor bulan dari nama
            if (!isset($months[$bulan])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nama bulan tidak valid.',
                ], 400);
            }

            $monthNumber = $months[$bulan];
            $tahunSaatIni = Carbon::now()->year;

            // Dapatkan tanggal awal dan akhir untuk bulan yang ditentukan
            $startDate = Carbon::createFromDate($tahunSaatIni, $monthNumber, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($tahunSaatIni, $monthNumber, 1)->endOfMonth();

            // Ambil total pembelian bahan baku untuk bulan yang ditentukan
            $pembelianBB = PembelianBB::whereBetween('tanggal_pembelian', [$startDate, $endDate])
                ->select('id_pembelian', 'harga_bahan_baku', 'tanggal_pembelian', 'jumlah_bb_dibeli', 'id_bahan_baku')
                ->get();

            // Calculate total purchase cost for each transaction
            $totalHargaBBDibeli = $pembelianBB->map(function ($item) {
                return $item->harga_bahan_baku * $item->jumlah_bb_dibeli;
            })->sum();

            // Return total pembelian bahan baku dalam respons JSON
            return response()->json([
                'success' => true,
                'data' => [
                    'total_bahan_baku' => $totalHargaBBDibeli ?? 0,
                ],
                'message' => 'Total pembelian bahan baku untuk bulan ' . ucfirst($bulan) . ' adalah: ' . $totalHargaBBDibeli,
            ], 200);

        } catch (\Exception $e) {
            // Tangani pengecualian
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil total pembelian bahan baku: ' . $e->getMessage(),
            ], 500);
        }
    }
}
