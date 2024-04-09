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
        $reseps = DetailResepBahanBaku::orderBy('id_resep','desc')->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }

    /**
     * create
     *
     * @return void
     */

    public function create()
    {
        $reseps = DetailResepBahanBaku::all();
        return view('adminResep.createResep', compact('reseps'));
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
            'nama_bahan_baku' => 'required',
            'total_penggunaan_bahan' => 'required',
        ]);

        $nama_resep = $request->input('nama_resep');
         $nama_bahan_baku = $request->input('nama_bahan_baku');
         $total_penggunaan_bahan = $request->input('total_penggunaan_bahan');
         
         $bahanBaku = BahanBaku::where('nama_bahan_baku', $nama_bahan_baku)->first();
         $resep_ = Resep::where('nama_resep', $nama_resep)->first();
         
         if ($bahanBaku && $resep_) {
            DetailResepBahanBaku::create([
                 'deskripsi_resep_produk'=> $resep_->nama_resep,
                 'id_resep' => $resep_->id_resep,
                 'id_bahan_baku' => $bahanBaku->id_bahan_baku,
                 'total_penggunaan_bahan' => $total_penggunaan_bahan,
             ]);

             return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Diubah!']);
         } else {
             return redirect()->route('reseps.index')->with(['error' => 'Nama Bahan baku atau Nama resep tidak ditemukan!']);
         }
    }

    /**
     * edit
     *
     * @param int $id
     * @return void
     */

    public function edit($id_resep, $id_bahanBaku)
    {
        $resep = DetailResepBahanBaku::where('id_resep', $id_resep)
        ->where('id_bahan_baku', $id_bahanBaku)
        ->first();
        return view('AdminResep.editResep', compact('resep'));
    }

    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */

    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */

     public function update(Request $request, $id_resep,$id_bahanBaku)
     {
         $resep = DetailResepBahanBaku::where('id_resep', $id_resep)
                                            ->where('id_bahan_baku', $id_bahanBaku);
 
         $this->validate($request, [
             'nama_resep' => 'required',
             'nama_bahan_baku' => 'required',
             'total_penggunaan_bahan' => 'required',
         ]);
 
         $nama_resep = $request->input('nama_resep');
         $nama_bahan_baku = $request->input('nama_bahan_baku');
         $total_penggunaan_bahan = $request->input('total_penggunaan_bahan');
         
         $bahanBaku = BahanBaku::where('nama_bahan_baku', $nama_bahan_baku)->first();
         $resep_ = Resep::where('nama_resep', $nama_resep)->first();
         
         if ($bahanBaku && $resep_) {
             $resep->update([
                 'id_resep' => $resep_->id_resep,
                 'id_bahan_baku' => $bahanBaku->id_bahan_baku,
                 'total_penggunaan_bahan' => $total_penggunaan_bahan,
             ]);
         
             return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Diubah!']);
         } else {
             return redirect()->route('reseps.index')->with(['error' => 'Bahan baku atau resep tidak ditemukan!']);
         }
     }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */

    public function destroy($id_resep, $id_bahanBaku)
    {
        $resep = DetailResepBahanBaku::where('id_resep', $id_resep)
                                        ->where('id_bahan_baku', $id_bahanBaku)
                                        ->delete();
        return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(Request $request)
    {
        $search = $request->search;

        $reseps = DetailResepBahanBaku::whereHas('resep', function ($query) use ($search) {
            $query->where('nama_resep', 'like', '%' . $search . "%");
        })->paginate(5);

        return view('AdminResep.indexResep', compact('reseps'));
    }


     public function search(Request $request){
        $search = $request->search;
        $reseps = DetailResepBahanBaku::whereHas('resep', function ($query) use ($search) {
            $query->where('nama_resep', 'like', '%' . $search . "%");
        })->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }
}
