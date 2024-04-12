<?php

namespace App\Http\Controllers;

use App\Models\DetailResepBahanBaku;
use App\Models\BahanBaku;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * create
     *
     * @return void
     */

    public function index()
    {
        $reseps = DetailResepBahanBaku::orderBy('id_resep', 'desc')->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }

    /**
     * create
     *
     * @return void
     */

    public function create()
    {
        $bahanBaku = BahanBaku::all();
        return view('adminResep.createResep', compact('bahanBaku'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_resep' => 'required',
            'id_bahan_baku' => 'required',
            'total_penggunaan_bahan' => 'required|numeric|min:1',
            'deskripsi_resep_produk' => 'required',
        ]);

        $id_bahan_baku = $request->input('id_bahan_baku');
        $total_penggunaan_bahan = $request->input('total_penggunaan_bahan');


        $bahanBaku = BahanBaku::find($id_bahan_baku);
        if ($bahanBaku) {
            if ($total_penggunaan_bahan > $bahanBaku->takaran_bahan_baku_tersedia) {
                return redirect()->back()->withErrors(['total_penggunaan_bahan' => 'Total penggunaan bahan baku tidak boleh melebihi takaran bahan baku tersedia.']);
            }
        }
        $nama_resep = $request->input('nama_resep');
        $deskripsi_resep_produk = $request->input('deskripsi_resep_produk');

        $resep = Resep::create(['nama_resep' => $nama_resep]);

        $resep->detailBahanBaku()->create([
            'id_bahan_baku' => $id_bahan_baku,
            'total_penggunaan_bahan' => $total_penggunaan_bahan,
            'deskripsi_resep_produk' => $deskripsi_resep_produk,
        ]);

        if ($bahanBaku) {
            $bahanBaku->takaran_bahan_baku_tersedia -= $total_penggunaan_bahan;
            $bahanBaku->save();
        }

        return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    /**
     * edit
     *
     * @param int $id
     * @return void
     */

    public function edit($id, $id_resep, $id_bahanBaku)
    {
        $resepDetail = DetailResepBahanBaku::find($id);
        $resep = Resep::find($id_resep);

        $bahanBaku = BahanBaku::all();

        return view('AdminResep.editResep', compact('resep', 'resepDetail', 'bahanBaku'));
    }


    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */

    public function update(Request $request, $id, $id_resep, $id_bahanBaku)
    {
        $this->validate($request, [
            'nama_resep' => 'required',
            'total_penggunaan_bahan' => 'required',
            'deskripsi_resep_produk' => 'required',
        ]);

        $nama_resep = $request->input('nama_resep');
        $total_penggunaan_bahan = $request->input('total_penggunaan_bahan');
        $deskripsi_resep_produk = $request->input('deskripsi_resep_produk');

        $resep = Resep::find($id_resep);
        if ($resep) {
            $resep->update(['nama_resep' => $nama_resep]);
        }

        $detailResep = DetailResepBahanBaku::find($id);

        if ($detailResep) {
            $bahanBaku = BahanBaku::find($id_bahanBaku);
            if ($bahanBaku) {
                $bahanBaku->takaran_bahan_baku_tersedia += $detailResep->total_penggunaan_bahan;
                $bahanBaku->save();


                $detailResep->update([
                    'deskripsi_resep_produk' => $deskripsi_resep_produk,
                    'total_penggunaan_bahan' => $total_penggunaan_bahan,
                ]);

                $bahanBaku->takaran_bahan_baku_tersedia -= $total_penggunaan_bahan;
                $bahanBaku->save();

                return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Diubah!']);
            } else {
                return redirect()->route('reseps.index')->with(['error' => 'Bahan Baku tidak ditemukan!']);
            }
        } else {
            return redirect()->route('reseps.index')->with(['error' => 'Detail Resep tidak ditemukan!']);
        }
    }



    /**
     * destroy
     *
     * @param int $id
     * @return void
     */

    public function destroy($id)
    {
        $resep = DetailResepBahanBaku::find($id);
        $resep->delete();
        return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }



    public function search(Request $request)
    {
        $search = $request->search;
        $reseps = DetailResepBahanBaku::whereHas('resep', function ($query) use ($search) {
            $query->where('nama_resep', 'like', '%' . $search . "%");
        })->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }
}
