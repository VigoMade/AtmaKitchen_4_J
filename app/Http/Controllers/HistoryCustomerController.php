<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryCustomerController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('customer')->id();
        $user = Transaksi::where('id_customer', $userId)
            ->whereIn('status', ['Diproses', 'Diterima', 'Menunggu Konfirmasi', 'Ditolak', 'Perlu Jarak', 'Menunggu Pembayaran', 'Pembayaran valid', 'Siap dipickup', 'Sedang dikirim kurir', 'Sudah dipickup', 'Selesai'])
            ->paginate(5);
        return view('HistoryCustomer.indexHistoryCust', compact('user'));
    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            return redirect()->route('historyCustomer.index');
        }

        try {
            $user = Transaksi::whereHas('produk', function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%$search%");
            })->orWhereHas('penitip', function ($query) use ($search) {
                $query->where('nama_produk_penitip', 'like', "%$search%");
            })->orWhereHas('hampers', function ($query) use ($search) {
                $query->where('nama_hampers', 'like', "%$search%");
            })->paginate(5);


            return view('HistoryCustomer.indexHistoryCust', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('historyCustomer.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            return redirect()->route('historyCustomer.index');
        }

        try {
            $user = Transaksi::whereHas('produk', function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%$search%");
            })->orWhereHas('penitip', function ($query) use ($search) {
                $query->where('nama_produk_penitip', 'like', "%$search%");
            })->orWhereHas('hampers', function ($query) use ($search) {
                $query->where('nama_hampers', 'like', "%$search%");
            })->paginate(5);

            return view('HistoryCustomer.indexHistoryCust', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('historyCustomer.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }

    public function destroy($id)
    {
        try {
            $transaksi = Transaksi::where('id_transaksi', $id)->first();
            $transaksi->delete();
            return redirect()->route('historyCustomer.index')->with(['success' => 'Berhasil Hapus']);
        } catch (Exception $e) {
            return redirect()->route('historyCustomer.index')->with(['error' => 'Gagal Hapus']);
        }
    }
}
