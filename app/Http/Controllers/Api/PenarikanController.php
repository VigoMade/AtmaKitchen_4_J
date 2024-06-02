<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PenarikanSaldo;
use App\Models\Rekening;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenarikanController extends Controller
{
    public function index($id)
    {
        try {
            $penarikan_saldo = DB::table('penarikan_saldo')
                ->select('penarikan_saldo.*', 'rekening.id_rekening', 'rekening.nama_bank', 'rekening.rekening_bank', 'customer.nama as nama_customer', 'customer.image')
                ->leftJoin('rekening', 'penarikan_saldo.id_rekening', '=', 'rekening.id_rekening')
                ->leftJoin('customer', 'rekening.id_customer', '=', 'customer.id_customer')
                ->where('customer.id_customer', $id)
                ->paginate(5);
    
            // Format each Penarikan object as a map
            $formattedPenarikan = $penarikan_saldo->map(function ($penarikan) {
                return [
                    'id_penarikan' => $penarikan->id_penarikan,
                    'id_rekening' => $penarikan->id_rekening,
                    'total_penarikan' => $penarikan->total_penarikan,
                    'status_penarikan' => $penarikan->status_penarikan,
                    'tanggal_penarikan' => $penarikan->tanggal_penarikan,
                    'nama_customer' => $penarikan->nama_customer,
                    'nama_bank' => $penarikan->nama_bank,
                    'rekening_bank' => $penarikan->rekening_bank,
                    // Add more fields as needed
                ];
            });
    
            return response()->json([
                'success' => true,
                'data' => $formattedPenarikan
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data: ' . $e->getMessage()
            ], 500);
        }
    }
    

    public function create($id)
    {
        try {
            $rekening = Rekening::where('id_customer', $id)->get();

            return response()->json([
                'success' => true,
                'data' => $rekening,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);

            // Validasi input termasuk saldo yang mencukupi
            $validator = Validator::make($request->all(), [
                'id_rekening' => 'required|exists:rekening,id_rekening',
                'total_penarikan' => 'required|numeric|min:0',
            ]);

            $validator->after(function ($validator) use ($customer, $request) {
                if ($request->total_penarikan > $customer->saldo_customer) {
                    $validator->errors()->add('total_penarikan', 'Jumlah penarikan tidak boleh melebihi saldo anda');
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 400);
            }

            DB::beginTransaction(); // Start a transaction

            // Update customer's saldo
            $customer->saldo_customer -= $request->total_penarikan;
            $customer->save();

            // Create penarikan saldo
            PenarikanSaldo::create([
                'tanggal_penarikan' => Carbon::now(),
                'id_customer' => $id,
                'id_rekening' => $request->id_rekening,
                'total_penarikan' => $request->total_penarikan,
                'status_penarikan' => 'Menunggu Konfirmasi',
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menarik saldo'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of error

            // Log the exception message
            \Log::error('Error in PenarikanController@store: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menarik saldo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSaldo($id)
{
    try {
        $saldo = Customer::findOrFail($id)->saldo_customer;

        return response()->json([
            'success' => true,
            'saldo' => $saldo,
        ], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Saldo not found for ID ' . $id,
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch saldo: ' . $e->getMessage()
        ], 500);
    }
}

}
