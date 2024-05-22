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
            ->whereIn('status', ['Pending', 'Selesai', 'Menunggu Konfirmasi', 'Ditolak'])
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
            })->whereHas('penitip', function ($query) use ($search) {
                $query->where('nama_produk_penitip', 'like', "%$search%");
            })->paginate(5);

            return view('HistoryCustomer.indexHistoryCust', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('historyCustomer.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }
}
