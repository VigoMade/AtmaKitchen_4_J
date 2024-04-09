<?php

namespace App\Http\Controllers;

use App\Models\DetailResepBahanBaku;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = DetailResepBahanBaku::orderBy('id_resep','desc')->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }

    public function create()
    {
        return view('AdminResep.createResep');
    }

    public function store(Request $request)
    {
        Resep::create($request->only('nama_resep'));
        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan.');
    }

    public function edit($id_resep, $id_bahanBaku)
    {
        $resep = DetailResepBahanBaku::find($id_resep, $id_bahanBaku);
        return view('AdminResep.editResep', compact('reseps'));
    }

    public function update(Request $request, Resep $resep)
    {
        $resep->update($request->only('nama_resep'));
        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui.');
    }

    public function destroy($id_resep, $id_bahanBaku)
    {
        $resep = DetailResepBahanBaku::where('id_resep', $id_resep)
                                        ->where('id_bahan_baku', $id_bahanBaku)
                                        ->firstOrFail();
        $resep->delete();
        return redirect()->route('reseps.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(Request $request)
    {
        $search = $request->search;
        $resep = Resep::where('nama_resep','like', '%' . $search . "%")->paginate(5);
        return view('AdminHampers.indexHampers', compact('reseps'));
    }

     public function search(Request $request){
        $search = $request->search;
        $resep = Resep::where('nama_resep','like', '%' . $search . "%")->paginate(5);
        return view('AdminResep.indexResep', compact('reseps'));
    }
}
