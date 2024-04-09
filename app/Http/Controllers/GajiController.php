<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pegawai = Gaji::orderBy('id_pegawai', 'desc')->paginate(5);
        return view('OWnerGaji.indexGaji', compact('pegawai'));
    }

    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $pegawai = Gaji::find($id);
        return view('OwnerGaji.editGaji', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Gaji::find($id);
        $this->validate($request, [
            'gaji' => 'required'
        ]);

        $gaji = $request->input('gaji');


        if ($request->has('bonus_gaji')) {
            $bonus = $request->input('bonus_gaji');
        } else {
            $bonus = 0;
        }

        $total_gaji = $gaji + $bonus;
        $pegawai->update(['gaji' => $total_gaji, 'bonus_gaji' => $bonus]);

        return redirect()->route('gaji.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
