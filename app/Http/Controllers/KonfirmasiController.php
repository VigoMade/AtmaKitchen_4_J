<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Customer;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

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
                DB::raw('COALESCE(h.nama_hampers, pr.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image, pr.image, pn.image) AS image')
            )
            ->whereIn('t.status', ['Pembayaran valid', 'Diterima', 'Diproses', 'Siap dipickup', 'Sedang dikirim kurir'])
            ->paginate(5);

        $bahanBaku = BahanBaku::where('takaran_bahan_baku_tersedia', '<=', 10)->paginate(5);

        return view('MOKonfirmasi.indexKonfirmasi', compact('transaksi', 'bahanBaku'));
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

    public function progress($id)
    {
        try {
            $pemasukan = Pemasukan::findOrFail($id);
            $transaksi = Transaksi::with('customer')->where('id_transaksi', $pemasukan->id_transaksi_fk)
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
            $customerDeviceKey = $transaksi->customer->device_key; // Asumsikan ada kolom 'device_key' di tabel pelanggan
            $title = 'Pesanan Diproses';
            $body = 'Pesanan Anda sedang diproses. Terima kasih atas pembeliannya.';
            $notificationResult = $this->notify($title, $body, $customerDeviceKey);
            
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
            $customerDeviceKey = $transaksi->customer->device_key; // Asumsikan ada kolom 'device_key' di tabel pelanggan
            $title = 'Pesanan Siap dipickup';
            $body = 'Pesanan Anda telah siap dipickup. Terima kasih telah menunggu.';
            $notificationResult = $this->notify($title, $body, $customerDeviceKey);
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
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
            $customerDeviceKey = $transaksi->customer->device_key; // Asumsikan ada kolom 'device_key' di tabel pelanggan
            $title = 'Pesanan Siap dipickup';
            $body = 'Pesanan Anda Sedang dikirim kurir. Terima kasih telah menunggu.';
            $notificationResult = $this->notify($title, $body, $customerDeviceKey);
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
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
            $customerDeviceKey = $transaksi->customer->device_key; // Asumsikan ada kolom 'device_key' di tabel pelanggan
            $title = 'Pesanan Sudah dipickup';
            $body = 'Pesanan Anda Sudah dipickup. Terima kasih telah menunggu.';
            $notificationResult = $this->notify($title, $body, $customerDeviceKey);
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
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
            $customerDeviceKey = $transaksi->customer->device_key; // Asumsikan ada kolom 'device_key' di tabel pelanggan
            $title = 'Pesanan Selesai';
            $body = 'Terimakasih atas Pembeliannya';
            $notificationResult = $this->notify($title, $body, $customerDeviceKey);
            return redirect()->route('indexKonfirmasi.index')->with('success', 'Transaksi berhasil Diproses.');
            return redirect()->route('historyCustomer.index')->with('success', 'Transaksi berhasil Selesai.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima transaksi: ' . $e->getMessage());
        }
    }

    static public function notify($title, $body, $device_key)
{
    // Mendapatkan path ke service account file
    $serviceAccountPath = base_path('serviceAccountKey.json');

    // Pastikan file service account ada
    if (!file_exists($serviceAccountPath)) {
        return [
            'message' => 'failed',
            'success' => false,
            'error' => 'Service account file not found.',
        ];
    }

    // Menginisialisasi Firebase Admin SDK
    $factory = (new Factory)->withServiceAccount($serviceAccountPath);
    $messaging = $factory->createMessaging();

    $message = [
        'notification' => [
            'title' => $title,
            'body' => $body,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'status' => 'done',
        ],
        'token' => $device_key,
    ];

    try {
        // Mengirimkan pesan menggunakan Firebase Admin SDK
        $messaging->send($message);
        return [
            'message' => 'success',
            'success' => true,
        ];
    } catch (\Throwable $th) {
        return [
            'message' => 'failed',
            'success' => false,
            'error' => $th->getMessage(),
        ];
    }
}

    // public function testqueues(Request $request)
    // {
    //     $users = Customer::whereNotNull('device_key')->whereNotNull9('delay')->get();
    // }
    
    public function notifyapp(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $device_key = $request->input('key');
    
        // Panggil fungsi notify dan kembalikan responsnya
        return $this->notify($title, $body, $device_key);
    }
    

}
