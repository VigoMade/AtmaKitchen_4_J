<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Customer;
use App\Models\DetailResepBahanBaku;
use App\Models\PemakaianBB;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Resep;
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
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('a.id_customer', '=', 't.id_customer')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->leftJoin('resep as r', 'pr.id_resep', '=', 'r.id_resep')
            ->leftJoin('detail_resep_bahan_baku as drrb', 'r.id_resep', '=', 'drrb.id_resep')
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
                'h.deskripsi_hampers',
                'h.id_hampers',
                'pr.id_resep',
                'drrb.*',
                DB::raw('COALESCE(h.nama_hampers, pr.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image, pr.image, pn.image) AS image')
            )
            ->whereIn('t.status', ['Pembayaran valid', 'Diterima'])
            ->paginate(5);

        $bahanBaku = BahanBaku::where('takaran_bahan_baku_tersedia', '<=', 10)->paginate(5);
        $pemakaian = PemakaianBB::paginate(5);

        return view('MOKonfirmasi.indexKonfirmasi', compact('transaksi', 'bahanBaku', 'pemakaian'));
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

            // if ($produk) {
            //     if ($produk->id_penitip) {
            //         $produk->stock_produk += $transaksi->jumlah_produk;
            //     } else {
            //         $produk->kuota += $transaksi->jumlah_produk;
            //     }
            //     $produk->save();
            // }

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
            $transaksi->poin_bonus = $poin;
            $transaksi->status = 'Diterima';
            $transaksi->save();

            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil diterima.' . $customer->poin_customer);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function progress($id, $deskripsi, $id_bahan_baku)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);

            $detail = DetailResepBahanBaku::where('deskripsi_resep_produk', $deskripsi)->first();
            if ($detail) {
                $totalPenggunaan = $detail->total_penggunaan_bahan;

                $bb = BahanBaku::find($id_bahan_baku);

                if ($bb->takaran_bahan_baku_tersedia < $totalPenggunaan) {
                    return redirect()->back()->with('error', 'Takaran bahan baku tersedia tidak mencukupi. ' . $bb->nama_bahan_baku);
                }

                PemakaianBB::create([
                    'id_bb' => $id_bahan_baku,
                    'tanggal_pemakaian' => Carbon::now(),
                    'total_pemakaian' => $totalPenggunaan
                ]);

                $bb->takaran_bahan_baku_tersedia -= $totalPenggunaan;
                if ($bb->takaran_bahan_baku_tersedia < 10) {
                    $bb->status_bahan_baku = 'Hampir habis';
                } else if ($bb->takaran_bahan_baku_tersedia == 0) {
                    $bb->status_bahan_baku = 'Habis';
                }
                $bb->save();
            }


            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $transaksi->status = 'Diproses';
            $produk = Produk::find($transaksi->id_produk_fk);
            if ($produk) {
                if ($produk->id_penitip) {
                    $produk->stock_produk -= $transaksi->jumlah_produk;
                } else {
                    $produk->kuota -= $transaksi->jumlah_produk;
                }
                $produk->save();
            }

            $transaksi->save();
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function pickUp($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $transaksi->status = 'Siap dipickup';
            $transaksi->save();
            return redirect()->route('indexAdminKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function send($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $transaksi->status = 'Sedang dikirim kurir';
            $transaksi->save();
            return redirect()->route('indexAdminKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function pickUpDone($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::where('id_transaksi', $pemasukan->id_transaksi_fk)
                ->where('tanggal_pembayaran', $pemasukan->transaksi->tanggal_pembayaran)
                ->firstOrFail();
            $transaksi->status = 'Sudah dipickup';
            $transaksi->save();
            return redirect()->route('indexAdminKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function done($id_transaksi)
    {
        try {
            $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
            $transaksi->status = 'Selesai';
            $transaksi->tanggal_selesai = Carbon::now();
            $transaksi->save();
            return redirect()->route('historyCustomer.index')->with('success', 'Transaksi berhasil Selesai.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    public function indexAdmin()
    {
        $transaksi = DB::table('pemasukan as p')
            ->leftJoin('transaksi as t', 'p.id_transaksi_fk', '=', 't.id_transaksi')
            ->leftJoin('produk as pr', 't.id_produk_fk', '=', 'pr.id_produk')
            ->leftJoin('penitip as pn', 'pr.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('customer as c', 't.id_customer', '=', 'c.id_customer')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('a.id_customer', '=', 't.id_customer')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->leftJoin('resep as r', 'pr.id_resep', '=', 'r.id_resep')
            ->leftJoin('detail_resep_bahan_baku as drrb', 'r.id_resep', '=', 'drrb.id_resep')
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
                'h.deskripsi_hampers',
                'h.id_hampers',
                'pr.id_resep',
                'drrb.*',
                DB::raw('COALESCE(h.nama_hampers, pr.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image, pr.image, pn.image) AS image')
            )
            ->whereIn('t.status', ['Diproses', 'Siap dipickup', 'Sedang dikirim kurir'])
            ->paginate(5);
        return view('AdminKonfirmasi.indexKonfirmasiPesanan', compact('transaksi'));
    }
}
