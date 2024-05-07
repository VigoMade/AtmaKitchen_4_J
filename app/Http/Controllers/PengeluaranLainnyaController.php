<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranLainnya;
use Exception;
use Illuminate\Http\Request;

class PengeluaranLainnyaController extends Controller
{
    public function index()
    {
        $pengeluaran
            = PengeluaranLainnya::orderBy('id_pengeluaran', 'desc')->paginate(5);
        return view('MOPengeluaranLainnya.indexPengeluaran', compact('pengeluaran'));
    }

    public function create()
    {
        return view('MOPengeluaranLainnya.createPengeluaran');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pengeluaran_lainnya' => 'required',
            'biaya_pengeluaran_lainnya' => 'required',
            'tanggal_pengeluaran_lainnya' => 'required',
        ]);

        try {
            PengeluaranLainnya::create($request->all());
            return redirect()->route('pengeluaranLainnya.index')->with(['success' => 'Data Berhasil Ditambah!']);;
        } catch (Exception $e) {
            return redirect()->route('pengeluaranLainnya.index')->with(['error' => 'Data Gagal Ditambah! Error: ' . $e->getMessage()]);;
        }
    }

    public function edit($id)
    {
        $pengeluaran = PengeluaranLainnya::find($id);
        return view('MOPengeluaranLainnya.editPengeluaran', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_pengeluaran_lainnya' => 'required',
            'biaya_pengeluaran_lainnya' => 'required',
            'tanggal_pengeluaran_lainnya' => 'required',
        ]);

        try {
            $pengeluaran = PengeluaranLainnya::find($id);
            $pengeluaran->update($request->all());
            return redirect()->route('pengeluaranLainnya.index')->with(['success' => 'Data Berhasil Diubah!']);;
        } catch (Exception $e) {
            return redirect()->route('pengeluaranLainnya.index')->with(['error' => 'Data Gagal Diubah! Error: ' . $e->getMessage()]);;
        }
    }

    public function destroy($id)
    {
        try {
            $pengeluaran = PengeluaranLainnya::find($id);
            $pengeluaran->delete();
            return redirect()->route('pengeluaranLainnya.index')->with(['success' => 'Data Berhasil Dihapus!']);;
        } catch (Exception $e) {
            return redirect()->route('pengeluaranLainnya.index')->with(['error' => 'Data Gagal Dihapus! Error: ' . $e->getMessage()]);;
        }
    }

    public function show(Request $request)
    {
        $search = $request->input('search');
        $pengeluaran = PengeluaranLainnya::where('nama_pengeluaran_lainnya', 'like', "%" . $search . "%")->paginate(5);
        return view('MOPengeluaranLainnya.indexPengeluaran', compact('pengeluaran'));
    }
}
