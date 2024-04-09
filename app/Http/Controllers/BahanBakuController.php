<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index()
    {
        $bahanBaku = BahanBaku::orderBy('id_bahan_baku', 'desc')->paginate(5);
        return view('AdminBahanBaku.indexBahanBaku', compact('bahanBaku'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $bahanBaku = BahanBaku::all();
        return view('adminBahanBaku.createBahanBaku', compact('bahanBaku'));
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
            'nama_bahan_baku' => 'required',
            'takaran_bahan_baku_tersedia' => 'required|numeric',
            'satuan_bahan_baku' => 'required',
        ]);

        $input = $request->all();
        BahanBaku::create($input);

        try {
            return redirect()->route('bahanBaku.index');
        } catch (Exception $e) {
            return redirect()->route('bahanBaku.index');
        }
    }

    /**
     * edit
     *
     * @param int $id
     * @return void
     */

    public function edit($id)
    {
        $bahanBaku = BahanBaku::find($id);
        return view('AdminBahanBaku.editBahanBaku', compact('bahanBaku'));
    }

    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::find($id);

        $this->validate($request, [
            'nama_bahan_baku' => 'required',
            'takaran_bahan_baku_tersedia' => 'required|numeric',
            'satuan_bahan_baku' => 'required',
        ]);

        $input = $request->all();
        $bahanBaku->update($input);

        return redirect()->route('bahanBaku.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

     /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $bahanBaku = BahanBaku::find($id);
        $bahanBaku->delete();
        return redirect()->route('bahanBaku.index')->with(['success' => 'Data 
            Berhasil Dihapus!']);
    }

    public function show(Request $request)
    {
        $search = $request->search;
        $bahanBaku = BahanBaku::where('nama_bahan_baku', 'like', "%" . $search . "%")->paginate(5);
        return view('adminBahanBaku.indexBahanBaku', compact('bahanBaku'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $bahanBaku = BahanBaku::where('nama_bahan_baku', 'like', "%" . $search . "%")->paginate(5);
        return view('adminBahanBaku.indexBahanBaku', compact('bahanBaku'));
    }
}
