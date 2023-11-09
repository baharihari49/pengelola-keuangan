<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class printController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dwonlodTransaksi()
    {
        $data = Transaksi::where('user_id', auth()->user()->id)
                            ->where('uuid', request()->uuid)
                            ->get();

        $pdf = Pdf::loadview('dashboard.transaksi.layouts.print.print_transaksi', ['data' => $data]);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function dwonlodTransaksiByMonth()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                                ->where('void', false);

         if (request()->id == 'all') {
            $transaksi = $transaksi->get();

            $namaBulan = null;
        } else {
            $transaksi = $transaksi->whereMonth('created_at', request()->id)->get();
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);
    
            $namaBulan = $tanggal->isoFormat('MMMM');
        };


        $pdf = Pdf::loadview('dashboard.transaksi.layouts.print.print_transaksi_by_month', ['transaksi' => $transaksi, 'bulan' => $namaBulan]);
        return $pdf->stream();        
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
