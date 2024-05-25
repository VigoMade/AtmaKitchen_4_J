<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    public function create()
    {
        return view('Transaksi.createAlamat');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat_customer' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('customer')->user();
        Alamat::create([
            'alamat_customer' => $request->alamat_customer,
            'id_customer' => $user->id_customer,
            'alamat_aktif' => '0',
        ]);

        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil ditambahkan']);
    }

    public function index()
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::Where('id_customer', $user->id_customer)->paginate(2);
        return view('Transaksi.indexAlamat', compact('alamat', 'user'));
    }

    public function destroy($id)
    {
        $alamat = Alamat::find($id);
        $alamat->delete();
        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil dihapus']);
    }

    public function edit($id)
    {
        $alamat = Alamat::find($id);
        return view('Transaksi.editAlamat', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alamat_customer' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alamat = Alamat::find($id);
        $alamat->alamat_customer = $request->alamat_customer;
        $alamat->save();

        return redirect()->route('alamat.index')->with(['success' => 'Alamat berhasil diperbarui']);
    }


    public function setAktif($id)
    {
        $alamat = Alamat::find($id);

        if ($alamat->alamat_aktif == 1) {
            $alamat->alamat_aktif = 0;
            $alamat->save();
            return redirect()->route('alamat.index')->with(['success' => 'Alamat Di Nonaktifkan']);
        } else {
            $userId = $alamat->id_customer;
            $alamatLainAktif = Alamat::where('id_customer', $userId)->where('alamat_aktif', 1)->first();
            if ($alamatLainAktif) {
                return redirect()->route('alamat.index')->with(['error' => 'Hanya satu alamat yang boleh aktif']);
            }
            $alamat->alamat_aktif = 1;
            $alamat->save();
            return redirect()->route('alamat.index')->with(['success' => 'Berhasil Set Alamat']);
        }
    }

    public function show(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $alamat = Alamat::where('alamat_customer', 'LIKE', '%' . $request->search . '%')
            ->where('id_customer', $user->id_customer)
            ->get();
        if ($alamat->isEmpty()) {
            return redirect()->route('alamat.index')->with(['error' => 'Alamat tidak ditemukan']);
        } else {
            return view('Transaksi.indexAlamat', compact('alamat', 'user'));
        }
    }

    public function indexJarak()
    {
        $transaksi = DB::table('transaksi as t')
            ->leftJoin('produk as p', 't.id_produk_fk', '=', 'p.id_produk')
            ->leftJoin('penitip as pn', 'p.id_penitip', '=', 'pn.id_penitip')
            ->leftJoin('hampers as h', 't.id_hampers', '=', 'h.id_hampers')
            ->leftJoin('alamat_customer as a', function ($join) {
                $join->on('t.id_alamat', '=', 'a.id_alamat')
                    ->where('a.alamat_aktif', '=', 1);
            })
            ->select(
                't.jumlah_produk',
                't.id_transaksi',
                't.total_pembayaran',
                't.ongkos_kirim',
                't.jarak',
                'a.alamat_customer',
                't.status',
                'h.deskripsi_hampers',
                'h.id_hampers',
                DB::raw('COALESCE(h.nama_hampers,p.nama_produk, pn.nama_produk_penitip) AS nama_produk'),
                DB::raw('COALESCE(h.image,p.image, pn.image) AS image'),
                'pn.nama_penitip'
            )->where(
                't.status',
                'Perlu Jarak',
            )->paginate(5);
        return view('AdminAlamat.indexAdminAlamat', compact('transaksi'));
    }

    public function createJarak($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        return view('AdminAlamat.createJarak', compact('transaksi'));
    }

    public function updateJarak(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        $this->validate($request, [
            'jarak' => 'required',
        ]);
        if ($request->jarak < 0) {
            return redirect()->back()->with(['error' => 'Jarak tidak boleh kurang dari 0']);
        } else if ($request->jarak <= 5) {
            $transaksi->ongkos_kirim = 10000;
            $transaksi->total_pembayaran = $transaksi->total_pembayaran + 10000;
        } else if ($request->jarak > 5 && $request->jarak <= 10) {
            $transaksi->ongkos_kirim = 15000;
            $transaksi->total_pembayaran = $transaksi->total_pembayaran + 15000;
        } else if ($request->jarak > 10 && $request->jarak <= 15) {
            $transaksi->ongkos_kirim = 20000;
            $transaksi->total_pembayaran = $transaksi->total_pembayaran + 20000;
        } else {
            $transaksi->ongkos_kirim = 25000;
            $transaksi->total_pembayaran = $transaksi->total_pembayaran + 25000;
        }
        try {
            $transaksi->status = 'Menunggu Pembayaran';
            $transaksi->jarak = $request->jarak;
            $transaksi->save();
            return redirect()->route('indexJarak')->with(['success' => 'Berhasil Menambahkan Jarak']);
        } catch (Exception $e) {
            return redirect()->route('indexJarak')->with(['errpr' => 'Gagal Update Jarak']);
        }
    }
}
