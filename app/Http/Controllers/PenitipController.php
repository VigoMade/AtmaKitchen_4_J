<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Penitip;

class PenitipController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $penitips = Penitip::orderBy('id_penitip', 'desc')->paginate(5);
        return view('MOPenitip.indexPenitip', compact('penitips'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('MOPenitip.createPenitip');
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
            'nama_penitip' => 'required',
            'nama_produk_penitip' => 'required',
            'jumlah_produk_penitip' => 'required|numeric',
            'jenis_produk_penitip' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'public/images';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $gambarPoster);
            $input['image'] = 'images/' . $gambarPoster;
        }

        $input['pembagian_komisi'] = 0;

        Penitip::create($input);

        try {
            return redirect()->route('penitip.index');
        } catch (Exception $e) {
            return redirect()->route('penitip.index');
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
        $penitip = Penitip::find($id);
        return view('MOPenitip.editPenitip', compact('penitip'));
    }

    /**
     * update
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $penitip = Penitip::find($id);

        $this->validate($request, [
            'nama_penitip' => 'required',
            'nama_produk_penitip' => 'required',
            'jumlah_produk_penitip' => 'required|numeric',
            'jenis_produk_penitip' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            if ($penitip->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $penitip->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $penitip->image)));
            }

            $destinationPath = 'public/images';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $gambarPoster);
            $input['image'] = 'images/' . $gambarPoster;
        } else {
            unset($input['foto']);
        }

        $penitip->update($input);

        return redirect()->route('penitip.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $penitip = Penitip::find($id);
        $penitip->delete();
        return redirect()->route('penitip.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(Request $request)
    {
        $search = $request->search;
        $penitips = Penitip::where('nama_penitip', 'like', '%' . $search . "%")->paginate(5);
        return view('MOPenitip.indexPenitip', compact('penitips'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $penitips = Penitip::where('nama_penitip', 'like', '%' . $search . "%")->paginate(5);
        return view('MOPenitip.indexPenitip', compact('penitips'));
    }
}
