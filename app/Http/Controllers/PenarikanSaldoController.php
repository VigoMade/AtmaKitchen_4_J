<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PenarikanSaldo;
use App\Models\Rekening;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenarikanSaldoController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        $penarikan_saldo = DB::table('penarikan_saldo')
            ->select('penarikan_saldo.*', 'rekening.id_rekening', 'rekening.nama_bank', 'rekening.rekening_bank', 'customer.nama as nama_customer', 'customer.image')
            ->leftJoin('rekening', 'penarikan_saldo.id_rekening', '=', 'rekening.id_rekening')
            ->leftJoin('customer', 'rekening.id_customer', '=', 'customer.id_customer')
            ->where('customer.id_customer', $user->id_customer)
            ->paginate(5);

        return view('HistoryCustomer.indexHistoryTarikSaldo', compact('penarikan_saldo'));
    }

    public function create()
    {
        $user = Auth::guard('customer')->user();
        $rekening = Rekening::where('id_customer', $user->id_customer)->get();
        return view('Customer.narikSaldo', compact('rekening', 'user'));
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::guard('customer')->user();
            $customer = Customer::find($user->id_customer);

            // Validasi input termasuk saldo yang mencukupi
            $validator = Validator::make($request->all(), [
                'id_rekening' => 'required',
                'total_penarikan' => 'required|numeric|min:0',
            ]);
            $validator->after(function ($validator) use ($customer, $request) {
                if ($request->total_penarikan > $customer->saldo_customer) {
                    $validator->errors()->add('total_penarikan', 'Jumlah penarikan tidak boleh melebihi saldo anda');
                }
            });
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $input = $request->all();
            $customer->saldo_customer -= $request->total_penarikan;
            $input['tanggal_penarikan'] = Carbon::now();
            $input['id_customer'] = $user->id_customer;
            $input['id_rekening'] = $request->id_rekening;
            $input['status_penarikan'] = 'Menunggu Konfirmasi';

            PenarikanSaldo::create($input);
            $customer->save();

            return redirect()->route('customer.index')->with('success', 'Berhasil menarik saldo');
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Gagal menarik saldo: ' . $e->getMessage());
        }
    }
}
