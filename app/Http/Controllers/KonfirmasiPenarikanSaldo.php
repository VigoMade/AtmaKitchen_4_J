<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PenarikanSaldo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfirmasiPenarikanSaldo extends Controller
{
    public function index()
    {

        $penarikan_saldo = DB::table('penarikan_saldo')
            ->select('penarikan_saldo.*', 'rekening.id_rekening', 'rekening.nama_bank', 'rekening.rekening_bank', 'customer.nama as nama_customer', 'customer.image', 'customer.id_customer')
            ->leftJoin('rekening', 'penarikan_saldo.id_rekening', '=', 'rekening.id_rekening')
            ->leftJoin('customer', 'rekening.id_customer', '=', 'customer.id_customer')
            ->paginate(5);

        return view('AdminKonfirmasi.indexKonfirmasiSaldo', compact('penarikan_saldo'));
    }

    public function terima($id)
    {
        $penarikan = PenarikanSaldo::find($id);
        try {
            $penarikan->status_penarikan = 'Selesai';
            $penarikan->save();
            return redirect()->route('konfirmasiSaldo.index')->with('success', 'Berhasil menerima penarikan saldo');
        } catch (Exception $e) {
            return redirect()->route('konfirmasiSaldo.index')->with('error', 'Gagal menerima penarikan saldo');
        }
    }

    public function tolak($id, $id_customer)
    {
        $penarikan = PenarikanSaldo::find($id);
        $customer = Customer::find($id_customer);
        try {
            $penarikan->status_penarikan = 'Ditolak';
            $customer->saldo_customer += $penarikan->total_penarikan;
            $customer->save();
            $penarikan->save();
            return redirect()->route('konfirmasiSaldo.index')->with('success', 'Berhasil Menolak penarikan saldo');
        } catch (Exception $e) {
            return redirect()->route('konfirmasiSaldo.index')->with('error', 'Gagal Menolak penarikan saldo');
        }
    }
}
