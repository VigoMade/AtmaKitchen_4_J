<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('id_customer', 'desc')->paginate(5);
        return view('AdminCustomer.indexCustomer', compact('customer'));
    }

    public function show(Request $request)
    {
        $search = $request->search;
        if (empty($search)) {
            return redirect()->route('dataCust.index');
        }
        $customer = Customer::where('nama', 'like', '%' . $search . "%")->paginate(5);
        if (!$customer) {
            return redirect()->route('dataCust.index')->with('error', 'Data tidak ditemukan.');
        }
        return view('AdminCustomer.indexCustomer', compact('customer'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if (empty($search)) {
            return redirect()->route('dataCust.index');
        }
        $customer = Customer::where('nama', 'like', '%' . $search . "%")->paginate(5);
        if (!$customer) {
            return redirect()->route('dataCust.index')->with('error', 'Data tidak ditemukan.');
        }
        return view('AdminCustomer.indexCustomer', compact('customer'));
    }
}
