<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenis_transaksiRequest;
use App\Http\Requests\UpdateJenis_transaksiRequest;
use App\Models\Jenis_transaksi;

class JenisTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreJenis_transaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenis_transaksiRequest $request, Jenis_transaksi $jenis_transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis_transaksi $jenis_transaksi)
    {
        //
    }

    public function api()
    {
        return Jenis_transaksi::all();
    }
}
