<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('t.id_alamat', '=', 'a.id_alamat')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->leftJoin('customer as c', 't.id_customer', '=', 'c.id_customer')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.tanggal_transaksi',
                't.ongkos_kirim',
                't.status',
                't.id_produk_fk',
                'h.id_hampers',
                't.bukti_bayar',
                'a.alamat_customer',
                'c.nama',
                DB::raw('COALESCE(p.nama_produk, pn.nama_produk_penitip,h.nama_hampers) AS nama_produk'),
                DB::raw('COALESCE(p.image, pn.image,h.image) AS image'),
            )->where('t.status', 'Sudah Dibayar')
            ->orWhere('t.status', 'Menunggu Pembayaran')
            ->orWhere('t.status', 'Lewat Bayar')
            ->paginate(5);

        foreach ($transaksi as $t) {
            if ($t->status == 'Menunggu Pembayaran' && Carbon::parse($t->tanggal_transaksi)->addHours(24)->isPast()) {
                $t->status = 'Lewat Bayar';
                $produk = Produk::where('id_produk', $t->id_produk_fk)->first();
                if ($produk->stock_produk > 0) {
                    $produk->stock_produk = $produk->stock_produk + $t->jumlah_produk;
                    $produk->save();
                } else {
                    $produk->kuota += $t->jumlah_produk;
                    $produk->tanggal_mulai_po = Carbon::now();
                    $produk->tanggal_selesai_po = Carbon::now()->addDays(3);
                    $produk->save();
                }

                DB::table('transaksi')->where('id_transaksi', $t->id_transaksi)->update(['status' => 'Lewat Bayar']);
            }
        }
        return view('AdminKonfirmasi.indexKonfirmasiAdmin', compact('transaksi'));
    }

    public function create($id_transaksi)
    {
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('t.id_alamat', '=', 'a.id_alamat')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->leftJoin('customer as c', 't.id_customer', '=', 'c.id_customer')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                'h.id_hampers',
                't.status',
                't.bukti_bayar',
                'a.alamat_customer',
                'c.nama',
                DB::raw('COALESCE(p.nama_produk, pn.nama_produk_penitip,h.nama_hampers) AS nama_produk'),
                DB::raw('COALESCE(p.image, pn.image,h.image) AS image'),
            )
            ->where('t.id_transaksi', $id_transaksi)
            ->first();

        return view('AdminKonfirmasi.createKonfirmasi', compact('transaksi'));
    }

    public function store(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        $request->validate([
            'total_pemasukan' => 'required|numeric|min:' . $transaksi->total_pembayaran
        ], [
            'total_pemasukan.min' => 'Pemasukan tidak boleh kurang dari total pembayaran.'
        ]);

        $input = $request->all();
        if ($request->total_pemasukan == $transaksi->total_pembayaran) {
            $input['tip'] = 0;
        } else if ($request->total_pemasukan > $transaksi->total_pembayaran) {
            $input['tip'] = $request->total_pemasukan - $transaksi->total_pembayaran;
        } else {
            $input['tip'] = 0;
        }
        $input['id_transaksi_fk'] = $id_transaksi;
        $input['tanggal_pemasukan'] = Carbon::now();
        try {
            $transaksi->status = 'Pembayaran Valid';
            $transaksi->save();
            Pemasukan::create($input);
            return redirect()->route('konfirmasiPembayaran.index')->with('success', 'Pemasukan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('konfirmasiPembayaran.index')->with('error', 'Pemasukan gagal ditambahkan');
        }
    }


    public function reject($id)
    {
        try {
            $transaksi = Transaksi::where('id_transaksi', $id)->first();
            $transaksi->status = 'Ditolak';
            $transaksi->save();
            return redirect()->route('konfirmasiPembayaran.index')->with(['success' => 'Berhasil Hapus']);
        } catch (Exception $e) {
            return redirect()->route('konfirmasiPembayaran.index')->with(['error' => 'Gagal Hapus']);
        }
    }
}
