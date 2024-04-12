<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Exception;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pegawai = Pegawai::orderBy('id_pegawai', 'desc')->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }


    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        return view('MOKaryawan.createKaryawan', compact('jabatan'));
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
            'nama_pegawai' => 'required',
            'telepon_pegawai' => 'required',
            'email_pegawai' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $fotoPegawai = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fotoPegawai);
            $input['foto'] = $fotoPegawai;
        }

        if ($request->input('id_role') === '') {
            $input['id_role'] = null;
        }

        $input['username'] = $request->input('username_pegawai', null);
        $input['password'] = $request->input('password_pegawai', null);
        $input['gaji'] = 0;
        $input['bonus_gaji'] = 0;

        try {
            Pegawai::create($input);
            return redirect()->route('pegawai.index');
        } catch (Exception $e) {
            return redirect()->route('pegawai.index')->with('error', $e->getMessage());
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
        $jabatan = Jabatan::all();
        $pegawai = Pegawai::find($id);
        return view('MOKaryawan.editKaryawan', compact('pegawai', 'jabatan'));
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
        $pegawai = Pegawai::find($id);
        $this->validate($request, [
            'nama_pegawai' => 'required',
            'telepon_pegawai' => 'required',
            'email_pegawai' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $fotoPegawai = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fotoPegawai);
            $input['foto'] = $fotoPegawai;
        } else {
            unset($input['foto']);
        }

        if ($request->input('id_role') === '') {
            $input['id_role'] = null;
        }

        $input['username'] = $request->input('username_pegawai', null);
        $input['password'] = $request->input('password_pegawai', null);
        $pegawai->update($input);

        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with(['success' => 'Data 
            Berhasil Dihapus!']);
    }


    public function show(Request $request)
    {
        $search = $request->search;
        $pegawai = Pegawai::where('nama_pegawai', 'like', "%" . $search . "%")->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pegawai = Pegawai::where('nama_pegawai', 'like', "%" . $search . "%")->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }
}
