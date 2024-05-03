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
        $customer = Customer::where('nama', 'like', '%' . $search . "%")->paginate(5);
        return view('AdminHampers.indexHampers', compact('customer'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $customer = Customer::where('nama', 'like', '%' . $search . "%")->paginate(5);
        return view('AdminHampers.indexHampers', compact('customer'));
    }
}
