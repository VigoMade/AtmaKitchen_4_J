<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    public function index($id)
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.tanggal_transaksi',
                't.tanggal_selesai',
                't.tanggal_pembayaran',
                't.poin_digunakan',
                't.poin_bonus',
                'h.deskripsi_hampers',
                'h.id_hampers',
                't.status',
                DB::raw('COALESCE(h.harga_hampers, p.harga_produk) AS harga_produk'),
                DB::raw('COALESCE(h.nama_hampers, p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image, p.image, pn.image) AS image'),
                'pn.nama_penitip',
                DB::raw('(COALESCE(h.harga_hampers, p.harga_produk) * t.jumlah_produk) AS total_seluruh'),
                DB::raw('(COALESCE(h.harga_hampers, p.harga_produk) * t.jumlah_produk + t.ongkos_kirim) AS total_pembayaran_baru'),
                DB::raw('(t.poin_digunakan * 100) AS poin_dipake'),
                DB::raw('((COALESCE(h.harga_hampers, p.harga_produk) * t.jumlah_produk) + t.ongkos_kirim - (t.poin_digunakan * 100)) AS total_setelah_diskon')
            )
            ->where('t.id_customer', $user->id_customer)
            ->where('t.status', 'Selesai')->where('t.id_transaksi', $id)
            ->first();
        return view('Customer.nota', compact('transaksi', 'alamat', 'user'));
    }
}
