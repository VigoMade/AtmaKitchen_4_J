<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoryAdminController extends Controller
{
    public function index()
    {
        $history = Transaksi::orderBy('id_transaksi', 'desc')->paginate(5);
        return view('AdminCustomer.historyCustomer', compact('history'));
    }
}
