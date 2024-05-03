<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\PembelianBB;
use Exception;
use Illuminate\Http\Request;

class PembelianBBController extends Controller
{
    public function index()
    {
        $pembelianBB = PembelianBB::orderBy('id_pembelian', 'desc')->paginate(5);
        return view('MOPembelianBahanBaku.indexPembelianBB', compact('pembelianBB'));
    }

    public function create()
    {
        $bahanBaku = BahanBaku::all();
        return view('MOPembelianBahanBaku.createPembelianBB', compact('bahanBaku'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'harga_bahan_baku' => 'required',
            'tanggal_pembelian' => 'required',
            'id_bahan_baku' => 'required',
        ]);
        $id_bahan_baku = $request->input('id_bahan_baku');
        $total_penambahan = $request->input('total_penambahan');
        $bahanBaku = BahanBaku::find($id_bahan_baku);
        if ($bahanBaku) {
            $bahanBaku->takaran_bahan_baku_tersedia += $total_penambahan;
            $bahanBaku->save();
        }
        try {
            PembelianBB::create($request->all());
            return redirect()->route('pembelianBB.index')->with(['success' => 'Data Berhasil Ditambah!']);;
        } catch (Exception $e) {
            return redirect()->route('pembelianBB.index')->with(['error' => 'Data Gagal Ditambah! Error: ' . $e->getMessage()]);;
        }
    }

    public function edit($id)
    {
        $pembelianBB = PembelianBB::find($id);
        $bahanBaku = BahanBaku::all();
        return view('MOPembelianBahanBaku.editPembelianBB', compact('pembelianBB', 'bahanBaku'));
    }

    public function update(Request $request, $id, $id_bahan_baku)
    {
        $this->validate($request, [
            'harga_bahan_baku' => 'required',
            'tanggal_pembelian' => 'required',
            'id_bahan_baku' => 'required',
        ]);
        $pembelianBB = PembelianBB::find($id);
        if ($pembelianBB) {
            $pembelianBB->update($request->all());
            $bahanBaku = BahanBaku::find($id_bahan_baku);
            if ($bahanBaku) {
                $bahanBaku->takaran_bahan_baku_tersedia -= $pembelianBB->total_penambahan;
                $bahanBaku->save();
                $bahanBaku->takaran_bahan_baku_tersedia += $request->total_penambahan;
                $bahanBaku->save();

                return redirect()->route('pembelianBB.index')->with(['success' => 'Data Berhasil Diubah!']);
            } else {
                return redirect()->route('pembelianBB.index')->with(['error' => 'Data Tidak ditemukan ']);
            }
        } else {
            return redirect()->route('pembelianBB.index')->with(['error' => 'Data Pembelian Tidak ditemukan ']);
        }
    }

    public function destroy($id)
    {
        try {
            $pembelianBB = PembelianBB::find($id);
            $bahanBaku = BahanBaku::find($pembelianBB->id_bahan_baku);
            if ($bahanBaku) {
                $bahanBaku->takaran_bahan_baku_tersedia -= $pembelianBB->total_penambahan;
                $bahanBaku->save();
            }
            $pembelianBB->delete();
            return redirect()->route('pembelianBB.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (Exception $e) {
            return redirect()->route('pembelianBB.index')->with(['error' => 'Data Gagal Dihapus! Error: ' . $e->getMessage()]);
        }
    }


    public function show(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            return redirect()->route('pembelianBB.index');
        }

        try {
            $bahanBaku = BahanBaku::where('nama_bahan_baku', 'LIKE', "%$search%")->first();

            if (!$bahanBaku) {
                return redirect()->route('pembelianBB.index')->with(['error' => 'Bahan baku tidak ditemukan']);
            }

            $pembelianBB = PembelianBB::where('id_bahan_baku', $bahanBaku->id_bahan_baku)->paginate(5);

            return view('MOPembelianBahanBaku.indexPembelianBB', compact('pembelianBB'));
        } catch (Exception $e) {
            return redirect()->route('pembelianBB.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            return redirect()->route('pembelianBB.index');
        }

        try {
            $bahanBaku = BahanBaku::where('nama_bahan_baku', 'LIKE', "%$search%")->first();

            if (!$bahanBaku) {
                return redirect()->route('pembelianBB.index')->with(['error' => 'Bahan baku tidak ditemukan']);
            }

            $pembelianBB = PembelianBB::where('id_bahan_baku', $bahanBaku->id_bahan_baku)->paginate(5);

            return view('MOPembelianBahanBaku.indexPembelianBB', compact('pembelianBB'));
        } catch (Exception $e) {
            return redirect()->route('pembelianBB.index')->with(['error' => 'Data tidak ditemukan']);
        }
    }
}
