<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('pemasukan as p')
            ->leftJoin('transaksi as t', 'p.id_transaksi_fk', '=', 't.id_transaksi')
            ->leftJoin('produk as pr', 't.id_produk_fk', '=', 'pr.id_produk')
            ->leftJoin('penitip as pn', 'pr.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('customer as c', 't.id_customer', '=', 'c.id_customer')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('a.id_customer', '=', 't.id_customer')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->select(
                'p.*',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.status',
                't.jumlah_produk',
                't.bukti_bayar',
                'a.alamat_customer',
                'c.nama AS nama_customer',
                DB::raw('COALESCE(pr.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(pr.image, pn.image) AS image')
            )
            ->whereIn('t.status', ['Pembayaran valid', 'Diterima'])
            ->paginate(5);
        return view('MOKonfirmasi.indexKonfirmasi', compact('transaksi'));
    }

    public function reject($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $customer = Customer::findOrFail($transaksi->id_customer);
            $customer->saldo_customer += $pemasukan->total_pemasukan;
            $customer->save();

            $pemasukan->total_pemasukan = 0;
            $pemasukan->save();

            $produk = Produk::find($transaksi->id_produk_fk);

            if ($produk) {
                if ($produk->id_penitip) {
                    $produk->stock_produk += $transaksi->jumlah_produk;
                } else {
                    $produk->kuota += $transaksi->jumlah_produk;
                }
                $produk->save();
            }

            $transaksi->status = 'Ditolak';
            $transaksi->jumlah_produk = 0;
            $transaksi->save();

            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil ditolak dan saldo dikembalikan ke customer.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak transaksi: ' . $e->getMessage());
        }
    }

    public function accept($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $customer = Customer::findOrFail($transaksi->id_customer);
            $poin = 0;
            $total_pembayaran = $transaksi->total_pembayaran;

            if ($total_pembayaran >= 1000000) {
                $poin += floor($total_pembayaran / 1000000) * 200;
                $total_pembayaran %= 1000000;
            }

            if ($total_pembayaran >= 500000) {
                $poin += floor($total_pembayaran / 500000) * 75;
                $total_pembayaran %= 500000;
            }
            if ($total_pembayaran >= 100000) {
                $poin += floor($total_pembayaran / 100000) * 15;
                $total_pembayaran %= 100000;
            }
            if ($total_pembayaran >= 10000) {
                $poin += floor($total_pembayaran / 10000);
            }

            $customerBirthday = Customer::whereDay('tanggal_ultah', Carbon::parse($customer->tanggal_ultah)->day)
                ->whereMonth('tanggal_ultah', Carbon::parse($customer->tanggal_ultah)->month)
                ->first();

            $customerBirthday = Carbon::parse($customer->tanggal_ultah);
            $now = Carbon::now();

            $diffInDays = $customerBirthday->diffInDays($now);


            if ($diffInDays >= -3 && $diffInDays <= 3) {
                $poin *= 2;
            }
            $customer->poin_customer += $poin;
            $customer->save();
            $transaksi->status = 'Diterima';
            $transaksi->save();

            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil diterima.' . $customer->poin_customer);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function progress($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $transaksi->status = 'Diproses';
            $transaksi->save();
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }
}
