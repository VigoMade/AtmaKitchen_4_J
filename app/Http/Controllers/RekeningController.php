<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $rekening = Rekening::where('id_customer', $user->id_customer)->paginate(2);
        return view('HistoryCustomer.myRekeningIndex', compact('rekening', 'user'));
    }

    public function create()
    {
        return view('HistoryCustomer.createRekening');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_bank' => 'required',
                'other_bank' => 'required_if:nama_bank,Other',
            ]);

            $nama_bank = $request->input('nama_bank');
            if ($nama_bank == 'Other') {
                $nama_bank = $request->input('other_bank');
            }
            $rekening = $request->input('rekening_bank');

            Rekening::create([
                'nama_bank' => $nama_bank,
                'rekening_bank' => $rekening,
                'id_customer' => Auth::guard('customer')->user()->id_customer,
            ]);

            return redirect()->route('rekening.index')->with('success', 'Rekening berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->route('rekening.index')->with('error', 'Rekening gagal ditambahkan! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $rekening = Rekening::find($id);
            $rekening->delete();
            return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('rekening.index')->with('error', 'Rekening gagal dihapus! ' . $e->getMessage());
        }
    }
}
