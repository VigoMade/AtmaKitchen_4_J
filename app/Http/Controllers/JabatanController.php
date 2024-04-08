<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Exception;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('MOJabatan.indexJabatan', compact('jabatan'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('MOJabatan.createJabatan');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'role' => 'required',
        ]);

        Jabatan::create([
            'role' => $request->role,
        ]);

        try {
            return redirect()->route('jabatan.index');
        } catch (Exception $e) {
            return redirect()->route('jabatan.index');
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
        $jabatan = Jabatan::find($id);
        return view('MOJabatan.editJabatan', compact('jabatan'));
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
        $jabatan = Jabatan::find($id);
        // validate form
        $this->validate($request, [
            'role' => 'required',
        ]);

        $jabatan->update([
            'role' => $request->role,
        ]);
        return redirect()->route('jabatan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with(['success' => 'Data 
            Berhasil Dihapus!']);
    }
}
