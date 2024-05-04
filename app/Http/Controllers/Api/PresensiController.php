<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensi = Presensi::with('pegawai')->get();

        if ($presensi->isNotEmpty()) {
            $presensiData = $presensi->map(function ($item) {
                return [
                    'id_presensi' => $item->id_presensi,
                    'tanggal_presensi' => $item->tanggal_presensi,
                    'status_presensi' => $item->status_presensi,
                    'nama_pegawai' => $item->pegawai->nama_pegawai,
                ];
            });

            return response([
                'message' => 'Retrieve All Success',
                'data' => $presensiData,
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }


    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $presensi = Presensi::find($id);
        if (!is_null($presensi)) {
            return response([
                'message'=> 'User found, it is'.$presensi->id_pegawai,
                'data'=> $presensi
                ],200);
    }
    return response([
        'message'=> 'User Not Found',
        'data'=> null
        ],404);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $presensi = Presensi::find($id);
        if (is_null($presensi)) {
            return response([
                'message'=> 'User Not Found',
                'data'=> null
            ],404);
        }
    
        // Ambil data yang diperbarui dari request
        $updateData = $request->all();
    
        // Perbarui properti status_presensi dari objek Presensi dengan nilai yang sesuai
        $presensi->status_presensi = $updateData['status_presensi'];
        $presensi->save(); // Simpan perubahan ke dalam database
    
        // Berikan respons yang sesuai setelah berhasil memperbarui data
        return response([
            'message'=> 'Update Content Success',
            'data'=> $presensi
        ],200);
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
}
