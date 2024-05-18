<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Hampers;

class HampersController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $hampers = Hampers::orderBy('id_hampers', 'desc')->paginate(5);
        return view('AdminHampers.indexHampers', compact('hampers'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('AdminHampers.createHampers');
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
            'nama_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'harga_hampers' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $gambarPoster);
            $input['image'] = $gambarPoster;
        }


        try {
            Hampers::create($input);
            return redirect()->route('hampers.index')->with(['success' => 'Data Berhasil Ditambah!']);
        } catch (Exception $e) {
            return redirect()->route('hampers.index')->with(['error' => 'Data Gagal Ditambah! Error: ' . $e->getMessage()]);
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
        $hamper = Hampers::find($id);
        return view('AdminHampers.editHampers', compact('hamper'));
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
        $hamper = Hampers::find($id);

        $this->validate($request, [
            'nama_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'harga_hampers' => 'required|numeric',
            'image' => 'image|mimes:jpeg,jpg,gif,svg,png|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $gambarPoster);
            $input['image'] = $gambarPoster;
        } else {
            unset($input['image']);
        }
        try {
            $hamper->update($input);

            return redirect()->route('hampers.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (Exception $e) {
            return redirect()->route('hampers.index')->with(['error' => 'Data Gagal Diubah! Error: ' . $e->getMessage()]);
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
        $hamper = Hampers::find($id);
        $hamper->delete();
        return redirect()->route('hampers.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(Request $request)
    {
        $search = $request->search;
        $hampers = Hampers::where('nama_hampers', 'like', '%' . $search . "%")->paginate(5);
        return view('AdminHampers.indexHampers', compact('hampers'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $hampers = Hampers::where('nama_hampers', 'like', '%' . $search . "%")->paginate(5);
        return view('AdminHampers.indexHampers', compact('hampers'));
    }
}
