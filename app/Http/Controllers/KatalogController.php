<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Hampers;
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
                'produk.tanggal_mulai_po',
                'produk.tanggal_selesai_po',
                'produk.status',
                'produk.kuota',
                'produk.stock_produk',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            )->where('produk.stock_produk', '>', 0)
            ->orWhere('produk.kuota', '>', 0)
            ->get();
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
                'produk.tanggal_mulai_po',
                'produk.tanggal_selesai_po',
                'produk.status',
                'produk.kuota',
                'produk.stock_produk',
                DB::raw('COALESCE(produk.image, penitip.image) AS image')
            );
        if ($jenis_produk == 'other') {
            $jenis = $query->whereNotIn(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), ['drink', 'cake', 'bread'])->get();
        } else {
            $jenis = $query->where(DB::raw('COALESCE(produk.jenis_produk, penitip.jenis_produk_penitip)'), $jenis_produk)->get();
        }


        return view('Katalog.informasiProduk', compact('jenis'));
    }

    public function showByTanggal(Request $request)
    {
        $tanggal = $request->tanggal;
        if (!$tanggal) {
            return redirect()->route('landingPageCustomer');
        } else {
            $jenis = DB::table('produk')
                ->leftJoin('penitip', 'produk.id_penitip', '=', 'penitip.id_penitip')
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
                )
                ->whereDate('produk.tanggal_selesai_po', $tanggal)->orWhereDate('produk.tanggal_mulai_po', $tanggal)
                ->get();

            return view('Katalog.informasiProdukTgl', compact('jenis'));
        }
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

    public function showHampers()
    {
        $hampers = Hampers::all();
        return view('Katalog.informasiHampers', compact('hampers'));
    }

    public function showHampersById($id_hampers)
    {
        $hampers = Hampers::find($id_hampers);
        return view('Katalog.detailHampers', compact('hampers'));
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
        $user = Auth::guard('customer')->user();
        $input['id_customer'] = Auth::guard('customer')->id();
        $alamat = DB::table('alamat_customer')->where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        if (!$alamat) {
            return redirect()->route('transaksi.index')->with(['error' => 'Alamat belum diatur']);
        }
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
        $id_transaksi = "$year.$month.$index";
        $existing_transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if ($existing_transaksi) {
            $index += 1;
            $input['id_transaksi'] = "$year.$month.$index";
        } else {
            $input['id_transaksi'] = "$year.$month.$index";
        }
        $input['status'] = 'Di Keranjang';

        try {
            Transaksi::create($input);
            return redirect()->route('transaksi.index')->with(['success' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function storeBuy(Request $request)
    {
        $this->validate(
            $request,
            [
                'jumlah_produk' => 'required',
            ]
        );
        $user = Auth::guard('customer')->user();
        $alamat = DB::table('alamat_customer')->where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        if (!$alamat) {
            return redirect()->route('transaksi.index')->with(['error' => 'Alamat belum diatur']);
        }
        $produk = Produk::find($request->id_produk);
        if ($produk->tipe_produk === 'Produk Penitip') {
            $this->validate($request, [
                'jumlah_produk' => 'numeric|max:' . $produk->stock_produk,
            ], [
                'jumlah_produk.max' => 'Jumlah produk tidak boleh melebihi stock produk (' . $produk->stock_produk . ')',
            ]);
        } else {
            $this->validate($request, [
                'jumlah_produk' => 'numeric|max:' . $produk->kuota,
            ], [
                'jumlah_produk.max' => 'Jumlah produk tidak boleh melebihi kuota produk (' . $produk->kuota . ')',
            ]);
        }
        $input = $request->all();
        $input['tanggal_transaksi'] = Carbon::now();
        $input['id_customer'] = Auth::guard('customer')->id();
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $index = Transaksi::count() + 1;
        $input['id_alamat'] = $alamat->id_alamat;
        $input['total_pembayaran']
            = $request->jumlah_produk * $request->harga_produk;
        $input['jumlah_produk'] = $request->jumlah_produk;
        $input['id_produk_fk'] = $request->id_produk;
        $produk = Produk::find($request->id_produk);
        if ($produk->id_penitip != null) {
            $input['id_penitip_fk'] = $produk->id_penitip;
        }

        $id_transaksi = "$year.$month.$index";
        $existing_transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if ($existing_transaksi) {
            $index += 1;
            $input['id_transaksi'] = "$year.$month.$index";
        } else {
            $input['id_transaksi'] = "$year.$month.$index";
        }
        $input['status'] = 'Perlu Jarak';

        try {
            Transaksi::create($input);
            return redirect()->route('transaksi.edit', $input['id_transaksi'])->with(['success' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function storeHampers(Request $request, $id)
    {
        $hampers = Hampers::find($id);
        $user = Auth::guard('customer')->user();
        $alamat = DB::table('alamat_customer')->where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        if (!$alamat) {
            return redirect()->route('transaksi.index')->with(['error' => 'Alamat belum diatur']);
        }
        $this->validate(
            $request,
            [
                'jumlah_produk' => 'required',
            ]
        );
        $input['id_customer'] = Auth::guard('customer')->id();
        $input['id_alamat'] = $alamat->id_alamat;
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $index = Transaksi::count() + 1;
        $input['total_pembayaran']
            = $request->jumlah_produk * $request->harga_hampers;
        $input['jumlah_produk'] = $request->jumlah_produk;
        $id_transaksi = "$year.$month.$index";
        $existing_transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if ($existing_transaksi) {
            $index += 1;
            $input['id_transaksi'] = "$year.$month.$index";
        } else {
            $input['id_transaksi'] = "$year.$month.$index";
        }
        if ($hampers->id_hampers != null) {
            $input['id_hampers'] = $hampers->id_hampers;
        }
        $input['status'] = 'Di Keranjang';
        try {
            Transaksi::create($input);
            return redirect()->route('transaksi.index')->with(['success' => 'Berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function storeHampersBuy(Request $request, $id)
    {
        $hampers = Hampers::find($id);
        $user = Auth::guard('customer')->user();
        $alamat = DB::table('alamat_customer')->where('id_customer', $user->id_customer)->where('alamat_aktif', 1)->first();
        if (!$alamat) {
            return redirect()->route('transaksi.index')->with(['error' => 'Alamat belum diatur']);
        }
        $this->validate(
            $request,
            [
                'jumlah_produk' => 'required',
            ]
        );
        $input['id_customer'] = Auth::guard('customer')->id();
        $input['id_alamat'] = $alamat->id_alamat;
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $input['tanggal_transaksi'] = Carbon::now();
        $index = Transaksi::count() + 1;
        $input['total_pembayaran']
            = $request->jumlah_produk * $request->harga_hampers;
        $input['jumlah_produk'] = $request->jumlah_produk;
        $id_transaksi = "$year.$month.$index";
        $existing_transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if ($existing_transaksi) {
            $index += 1;
            $input['id_transaksi'] = "$year.$month.$index";
        } else {
            $input['id_transaksi'] = "$year.$month.$index";
        }
        if ($hampers->id_hampers != null) {
            $input['id_hampers'] = $hampers->id_hampers;
        }
        $input['status'] = 'Perlu Jarak';
        try {
            Transaksi::create($input);
            return redirect()->route('transaksi.edit', $input['id_transaksi'])->with(['success' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with(['error' => $e->getMessage()]);
        }
    }
}
