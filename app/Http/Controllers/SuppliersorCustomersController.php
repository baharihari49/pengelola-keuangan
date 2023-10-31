<?php

namespace App\Http\Controllers;

use App\Models\suppliers_or_customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersorCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showSupOrCus()
    {

        return suppliers_or_customers::where('user_id', auth()->user()->id)
                                  ->where('jenis_transaksi_id', request()->id)
                                  ->get();
    }

    public function hapusSeeder()
    {
        DB::table('suppliers_or_customers')->truncate();
        return suppliers_or_customers::where('user_id', auth()->user()->id)
                                  ->where('jenis_transaksi_id', request()->id)
                                  ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(suppliers_or_customers $suppliers_or_customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suppliers_or_customers $suppliers_or_customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, suppliers_or_customers $suppliers_or_customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suppliers_or_customers $suppliers_or_customers)
    {
        //
    }
}
