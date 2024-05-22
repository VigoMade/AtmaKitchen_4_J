<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{

    public function index()
    {
        $produk = DB::table('produk')
            ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->select(
                DB::raw('COALESCE(produk.nama_produk, penitip.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip) AS jenis_produk'),
                'produk.harga_produk',
                'produk.id_produk',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            )->get();
        return view('landingPageCustomer', compact('produk'));
    }
    public function show($jenis_produk)
    {
        $query = DB::table('produk')
            ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->select(
                DB::raw('COALESCE(produk.nama_produk, penitip.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip) AS jenis_produk'),
                'produk.harga_produk',
                'produk.id_produk',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            );
        if ($jenis_produk == 'other') {
            $jenis = $query->whereNotIn(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), ['drink', 'cake', 'bread'])->get();
        } else {
            $jenis = $query->where(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), $jenis_produk)->get();
        }


        return view('Katalog.informasiProduk', compact('jenis'));
    }

    public function showById($id_produk)
    {
        $produk = DB::table('produk')->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
            ->select(
                DB::raw('COALESCE(produk.nama_produk, penitip.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip) AS jenis_produk'),
                'produk.harga_produk',
                'produk.id_produk',
                'produk.status',
                'produk.tanggal_mulai_po',
                'produk.tanggal_selesai_po',
                'produk.tipe_produk',
                'produk.satuan_produk',
                'produk.stock_produk',
                'produk.kuota',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            )->where('produk.id_produk', $id_produk)->first();

        return view('Katalog.detailProduk', compact('produk'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'jumlah_produk' => 'required',
            ]
        );

        $input = $request->all();
        $input['id_customer'] = Auth::guard('customer')->id();
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');

        $index = Transaksi::count() + 1;
        $input['total_pembayaran']
            = $request->jumlah_produk * $request->harga_produk;
        $input['jumlah_produk'] = $request->jumlah_produk;
        $input['id_produk_fk'] = $request->id_produk;
        $produk = Produk::find($request->id_produk);
        if ($produk->id_penitip != null) {
            $input['id_penitip_fk'] = $produk->id_penitip;
        }
        $input['id_transaksi'] = "$year.$month.$index";
        $input['status'] = 'Di Keranjang';

        try {
            Transaksi::create($input);
            return redirect()->route('transaksi.index')->with(['success' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with(['error' => $e->getMessage()]);
        }
    }
}
