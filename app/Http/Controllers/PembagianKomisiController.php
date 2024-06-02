<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembagianKomisiController extends Controller
{
    public function index()
    {
        $pembagian = DB::table('pemasukan')
            ->select(
                'pemasukan.id_pemasukan',
                'pemasukan.id_transaksi_fk',
                'pemasukan.total_pemasukan',
                DB::raw('pemasukan.total_pemasukan * 0.2 AS pembagian_komisi'),
                'penitip.nama_penitip',
                'penitip.nama_produk_penitip',
                'penitip.id_penitip'
            )
            ->leftJoin('transaksi', 'pemasukan.id_transaksi_fk', '=', 'transaksi.id_transaksi')
            ->leftJoin('produk', 'transaksi.id_produk_fk', '=', 'produk.id_produk')
            ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->whereNotNull('produk.id_penitip')
            ->paginate(5);

        return view('OwnerPembagianKomisi.indexPembagianKomisi', compact('pembagian'));
    }


    public function pembagian($id_pemasukan, $id_penitip)
    {
        try {

            $pemasukan = Pemasukan::find($id_pemasukan);

            $total_komisi = $pemasukan->total_pemasukan * 0.2;


            $penitip = Penitip::find($id_penitip);
            if ($penitip->pembagian_komisi != null) {
                $penitip->pembagian_komisi += $total_komisi;
            } else {
                $penitip->pembagian_komisi = $total_komisi;
            }
            $penitip->save();

            return redirect()->route('OwnerPembagianKomisi.index')->with('success', 'Berhasil membagikan komisi');
        } catch (\Exception $e) {
            return redirect()->route('OwnerPembagianKomisi.index')->with('error', 'Gagal membagikan komisi');
        }
    }
}
