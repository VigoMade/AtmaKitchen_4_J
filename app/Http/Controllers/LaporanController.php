<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Pemasukan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{


    public function pemasukanPengeluaran(Request $request)
    {
        setlocale(LC_TIME, 'id_ID');

        $bulan = substr($request->bulan, 5);
        $pemasukanPengeluaran = DB::table(DB::raw("(SELECT 
        DATE_FORMAT(tanggal_pemasukan, '%Y-%m-01') AS tanggal,
        total_pemasukan,
        tip,
        NULL AS nama_pengeluaran_lainnya,
        NULL AS biaya_pengeluaran_lainnya
    FROM 
        pemasukan

    UNION ALL

    SELECT 
        DATE_FORMAT(tanggal_pengeluaran_lainnya, '%Y-%m-01') AS tanggal,
        NULL AS total_pemasukan,
        NULL AS tip,
        nama_pengeluaran_lainnya,
        biaya_pengeluaran_lainnya
    FROM 
        pengeluaran_lainnya) AS combined"))
            ->select(
                'tanggal',
                DB::raw('SUM(total_pemasukan) AS pemasukan'),
                DB::raw('SUM(tip) AS total_tip'),
                'nama_pengeluaran_lainnya',
                'biaya_pengeluaran_lainnya'
            )
            ->where(DB::raw("DATE_FORMAT(tanggal, '%m')"), '=', $bulan)
            ->groupBy('tanggal', 'nama_pengeluaran_lainnya', 'biaya_pengeluaran_lainnya')
            ->orderBy('tanggal')
            ->limit(25)
            ->get();
        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        list($tahun, $bulan) = explode('-', $request->bulan);


        $bulanObj = Carbon::createFromDate($tahun, $bulan, 1);
        $namaBulan = $bulanObj->translatedFormat('F');

        $totalMasuk = DB::table('pemasukan')
            ->whereMonth('tanggal_pemasukan', $bulan)
            ->sum(DB::raw('total_pemasukan + tip'));

        $totalKeluar = DB::table('pengeluaran_lainnya')
            ->whereMonth('tanggal_pengeluaran_lainnya', $bulan)
            ->sum('biaya_pengeluaran_lainnya');

        return view('Laporan.laporanPemasukanPengeluaran', compact('pemasukanPengeluaran', 'tanggalFormat', 'namaBulan', 'tahun', 'totalMasuk', 'totalKeluar'));
    }

    public function laporanPresensi(Request $request)
    {
        setlocale(LC_TIME, 'id_ID');

        $bulan = substr($request->bulan, 5);
        $laporanPresensi = DB::table('presensi')
            ->select(
                'pegawai.nama_pegawai',
                'pegawai.gaji',
                'pegawai.bonus_gaji',
                DB::raw('SUM(CASE WHEN presensi.status_presensi = "Hadir" THEN 1 ELSE 0 END) AS jumlah_hadir'),
                DB::raw('SUM(CASE WHEN presensi.status_presensi = "Alpha" THEN 1 ELSE 0 END) AS jumlah_alpha'),
                DB::raw('(SUM(CASE WHEN presensi.status_presensi = "Hadir" THEN 1 ELSE 0 END) * (IFNULL(pegawai.gaji,0)) + IFNULL(pegawai.bonus_gaji,0)) AS total_gaji')
            )
            ->join('pegawai', 'presensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->whereMonth('presensi.tanggal_presensi', $bulan)
            ->groupBy('pegawai.nama_pegawai', 'pegawai.gaji', 'pegawai.bonus_gaji')
            ->get();

        $totalKeseluruhan = $laporanPresensi->sum('total_gaji');


        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        list($tahun, $bulan) = explode('-', $request->bulan);

        $bulanObj = Carbon::createFromDate($tahun, $bulan, 1);
        $namaBulan = $bulanObj->translatedFormat('F');

        return view('Laporan.laporanPresensiGaji', compact('laporanPresensi', 'tanggalFormat', 'namaBulan', 'tahun', 'totalKeseluruhan'));
    }

    public function laporanPenitip(Request $request)
    {
        setlocale(LC_TIME, 'id_ID');

        $bulan = substr($request->bulan, 5);

        $laporan = DB::table('pemasukan')
            ->select(
                'pemasukan.id_transaksi_fk',
                'pemasukan.total_pemasukan',

                'penitip.nama_penitip',
                'penitip.nama_produk_penitip',
                'penitip.id_penitip',
                'transaksi.jumlah_produk',
                DB::raw('(transaksi.jumlah_produk * produk.harga_produk)* 0.2 AS pembagian_komisi'),
                DB::raw('transaksi.jumlah_produk * produk.harga_produk AS semuaHarga'),
                'produk.harga_produk',
                DB::raw('SUM(transaksi.jumlah_produk * produk.harga_produk - (transaksi.jumlah_produk * produk.harga_produk)* 0.2) AS diterima')
            )
            ->leftJoin('transaksi', 'pemasukan.id_transaksi_fk', '=', 'transaksi.id_transaksi')
            ->leftJoin('produk', 'transaksi.id_produk_fk', '=', 'produk.id_produk')
            ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->whereNotNull('produk.id_penitip')
            ->whereMonth('pemasukan.tanggal_pemasukan', $bulan)
            ->groupBy('penitip.id_penitip', 'pemasukan.id_transaksi_fk', 'pemasukan.total_pemasukan', 'penitip.nama_penitip', 'penitip.nama_produk_penitip', 'transaksi.jumlah_produk', 'produk.harga_produk', 'semuaHarga')
            ->get();

        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        list($tahun, $bulan) = explode('-', $request->bulan);

        $bulanObj = Carbon::createFromDate($tahun, $bulan, 1);
        $namaBulan = $bulanObj->translatedFormat('F');
        return view('Laporan.laporanTransaksiPenitip', compact('laporan', 'bulan', 'namaBulan', 'tanggalFormat', 'tahun'));
    }

    public function laporanPenggunaanBB(Request $request)
    {
        $bulanAwal = $request->input('bulan_awal');
        $bulanAkhir = $request->input('bulan_akhir');


        if (empty($bulanAwal) || empty($bulanAkhir)) {
            return redirect()->back()->withErrors(['msg' => 'Bulan awal dan akhir harus diisi!']);
        }


        $tanggalAwal = Carbon::parse($bulanAwal)->startOfMonth();
        $tanggalAkhir = Carbon::parse($bulanAkhir)->endOfMonth();


        $laporan = DB::table('pemakaian_bb')
            ->leftJoin('bahan_baku', 'pemakaian_bb.id_bb', '=', 'bahan_baku.id_bahan_baku')
            ->select(
                'bahan_baku.nama_bahan_baku as nama',
                'bahan_baku.satuan_bahan_baku as satuan',
                'pemakaian_bb.total_pemakaian'
            )
            ->whereBetween('pemakaian_bb.tanggal_pemakaian', [$tanggalAwal, $tanggalAkhir])
            ->get();


        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        $bulanObjAwal = Carbon::createFromDate($bulanAwal);
        $bulanObjAkhir = Carbon::createFromDate($bulanAkhir);

        $namaBulanAwal = $bulanObjAwal->translatedFormat('F');
        $namaBulanAkhir = $bulanObjAkhir->translatedFormat('F');

        return view('Laporan.laporanPengunaanBB', compact(
            'laporan',
            'namaBulanAwal',
            'namaBulanAkhir',
            'tanggalFormat',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }

    public function laporanPenjualan()
    {
        $laporanBulanan = DB::table('pemasukan')
            ->select(
                DB::raw("DATE_FORMAT(tanggal_pemasukan, '%Y-%m') AS bulan"),
                DB::raw('COUNT(*) AS jumlah_transaksi'),
                DB::raw('SUM(total_pemasukan) AS total_pemasukan_bulanan')
            )
            ->groupBy(DB::raw("DATE_FORMAT(tanggal_pemasukan, '%Y-%m')"))
            ->orderBy('bulan')
            ->get();

        $totalKeseluruhan = DB::table('pemasukan')
            ->select(
                DB::raw("'Total Keseluruhan' AS bulan"),
                DB::raw('COUNT(*) AS jumlah_transaksi'),
                DB::raw('SUM(total_pemasukan) AS total_pemasukan_bulanan')
            )
            ->first();

        $totalKeseluruhan = collect([$totalKeseluruhan]);
        $laporan = $laporanBulanan->concat($totalKeseluruhan);

        $chartData = $laporanBulanan->filter(function ($value) {
            return $value->bulan !== 'Total Keseluruhan';
        })->values();

        return view('Laporan.laporanPenjualanBulanan', compact('laporan', 'chartData'));
    }

    public function laporanBB()
    {
        $laporan = BahanBaku::all();
        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        return view('Laporan.laporanStockBB', compact('laporan', 'tanggalFormat'));
    }


    public function laporanLaporan(Request $request)
    {
        setlocale(LC_TIME, 'id_ID');

        $bulan = substr($request->bulan, 5);

        $laporan = DB::table('pemasukan as p')
            ->leftJoin('transaksi as t', 'p.id_transaksi_fk', '=', 't.id_transaksi')
            ->leftJoin('produk as pr', 't.id_produk_fk', '=', 'pr.id_produk')
            ->leftJoin('penitip as pn', 'pr.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('customer as c', 't.id_customer', '=', 'c.id_customer')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('resep as r', 'pr.id_resep', '=', 'r.id_resep')
            ->select(
                'p.*',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.status',
                't.jumlah_produk',
                't.bukti_bayar',
                'c.nama AS nama_customer',
                'h.deskripsi_hampers',
                'h.id_hampers',
                'pr.id_resep',
                DB::raw('COALESCE(pr.harga_produk, h.harga_hampers) AS harga_produk'),
                DB::raw('COALESCE(h.nama_hampers, pr.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image, pr.image, pn.image) AS image'),
                DB::raw('(COALESCE(pr.harga_produk, h.harga_hampers) * t.jumlah_produk) AS total_masuk')
            )
            ->whereMonth('p.tanggal_pemasukan', $bulan)
            ->orderBy('p.tanggal_pemasukan')
            ->get();


        $tanggalHari = Carbon::now();
        $tanggalFormat = $tanggalHari->isoFormat('D MMMM YYYY');

        list($tahun, $bulan) = explode('-', $request->bulan);
        $total = $laporan->sum('total_masuk');

        $bulanObj = Carbon::createFromDate($tahun, $bulan, 1);
        $namaBulan = $bulanObj->translatedFormat('F');
        return view('Laporan.laporanPenjualanProduk', compact('laporan', 'bulan', 'namaBulan', 'tanggalFormat', 'tahun', 'total'));
    }
}
