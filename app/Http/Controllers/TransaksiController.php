<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.status',
                DB::raw('COALESCE(p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )
            ->where('t.id_customer', $user->id_customer)
            ->where('t.status', 'Di Keranjang')
            ->paginate(2);

        return view('Transaksi.showAllTransaksi', compact('transaksi', 'alamat', 'user'));
    }

    public function edit($id)
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.status',
                DB::raw('COALESCE(p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )
            ->where('t.id_customer', $user->id_customer)
            ->where('t.status', 'Di Keranjang')->where('t.id_transaksi', $id)
            ->first();
        return view('Transaksi.pembayaranPage', compact('transaksi', 'alamat', 'user'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        $beliData = $request->all();
        $validate = Validator::make($beliData, [
            'id_produk_fk' => 'required',
            'jumlah_produk' => 'required',
            'total_pembayaran' => 'required',
            'ongkos_kirim' => 'required',
        ]);
        if ($image = $request->file('bukti_bayar')) {
            if ($transaksi->bukti_bayar && file_exists(storage_path('app/public/' . str_replace('storage/', '', $transaksi->bukti_bayar)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $transaksi->bukti_bayar)));
            }

            $destinationPath = 'public/images';
            $fotoPegawai = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $fotoPegawai);
            $beliData['bukti_bayar'] = 'images/' . $fotoPegawai;
        } else {
            unset($beliData['bukti_bayar']);
        }
        $beliData['id_customer'] = $user->id_customer;
        $beliData['status'] = 'Menunggu Konfirmasi';
        $beliData['tanggal_transaksi'] = Carbon::now();
        $beliData['tanggal_pembayaran'] = Carbon::now();
        $beliData['jumlah_produk'] = $transaksi->jumlah_produk;
        $beliData['total_pembayaran'] = $transaksi->total_pembayaran;
        $beliData['ongkos_kirim'] = $transaksi->ongkos_kirim;
        try {
            $transaksi->update($beliData);
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil');
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with('error', $e->getMessage());
        }
    }
}
