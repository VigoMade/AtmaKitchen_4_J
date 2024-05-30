<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Customer;
use App\Models\Pemasukan;
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
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                'h.deskripsi_hampers',
                'h.id_hampers',
                't.status',
                DB::raw('COALESCE(h.nama_hampers,p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image,p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )
            ->where('t.id_customer', $user->id_customer)
            ->where('t.status', 'Di Keranjang')->paginate(2);

        return view('Transaksi.showAllTransaksi', compact('transaksi', 'alamat', 'user'));
    }

    public function edit($id)
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
                'h.deskripsi_hampers',
                'h.id_hampers',
                't.status',
                DB::raw('COALESCE(h.nama_hampers,p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image,p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )
            ->where('t.id_customer', $user->id_customer)
            ->where(function ($query) {
                $query->where('t.status', 'Di Keranjang')
                    ->orWhere('t.status', 'Menunggu Pembayaran')
                    ->orWhere('t.status', 'Perlu Jarak')
                    ->orWhere('t.status', 'send')
                    ->orWhere('t.status', 'pickup');
            })->where('t.id_transaksi', $id)
            ->first();
        return view('Transaksi.pembayaranPage', compact('transaksi', 'alamat', 'user'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::Where('id_transaksi', $id)->first();
        $user = Auth::guard('customer')->user();
        $idCust = $user->id_customer;
        $alamat = Alamat::where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        $customer = Customer::find($idCust);
        $beliData = $request->all();
        $validate = Validator::make($beliData, [
            'id_produk_fk' => 'required',
            'jumlah_produk' => 'required',
            'total_pembayaran' => 'required',
            'ongkos_kirim' => 'required',

        ]);
        if ($request->poin_digunakan > $customer->poin_customer) {
            return redirect()->route('transaksi.index')->with('error', 'Poin yang digunakan melebihi poin yang dimiliki');
        } else if ($request->poin_digunakan > 0) {
            $beliData['poin_digunakan'] = $request->poin_digunakan;
            $customer->poin_customer -= $request->poin_digunakan;
            $customer->save();
        } else {
            $beliData['poin_digunakan'] = 0;
        }
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
        $beliData['id_alamat'] = $alamat->id_alamat;
        if ($transaksi->status == 'Menunggu Pembayaran') {
            $beliData['status'] = 'Sudah Dibayar';
        } else if ($request->status == 'pickup') {
            $beliData['status'] = 'Menunggu Pembayaran';
        } else {
            $beliData['status'] = 'Perlu Jarak';
        }
        if ($transaksi->tanggal_transaksi == null) {
            $beliData['tanggal_transaksi'] = Carbon::now();
        }
        $beliData['tanggal_pembayaran'] = Carbon::now();
        $beliData['jumlah_produk'] = $transaksi->jumlah_produk;
        $beliData['total_pembayaran'] =
            $request->total_pembayaran;;
        $beliData['ongkos_kirim'] = $transaksi->ongkos_kirim;

        try {
            $transaksi->update($beliData);
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil');
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with('error', $e->getMessage());
        }
    }
}
