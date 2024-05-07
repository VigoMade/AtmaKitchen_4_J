<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Pegawai;
use Exception; // Pastikan menggunakan use Exception di atas namespace
use Illuminate\Http\Request;

class PegawaiControllerM extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index_mobile()
    {
        $pegawai = Pegawai::all();
        return response([
            'message'=> 'Retrieve All Success',
            'data' => $pegawai,
            ],200);
    }
}
