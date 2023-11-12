<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Helper\DatabaseHelper;

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
                                ->where('void', false)
                                ->with('jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers');

         if (request()->id == 'all') {
            $transaksi = $transaksi->get();

            $namaBulan = null;
        } else {
            $transaksi = $transaksi->whereMonth('tanggal', request()->id)->get();
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);
    
            $namaBulan = $tanggal->isoFormat('MMMM');
        };


        $pdf = Pdf::loadview('dashboard.transaksi.layouts.print.print_transaksi_by_month', ['transaksi' => $transaksi, 'bulan' => $namaBulan]);
        return $pdf->setPaper('a4', 'landscape')->stream();        
    }

    public function dwonlodTransaksiPemasukan() 
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 1)
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers']);

        if(request()->id == 'all'){
            $transaksi->get();
            $namaBulan = null;
        }else{
            $transaksi->whereMonth('tanggal', request()->id);
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);
    
            $namaBulan = $tanggal->isoFormat('MMMM');
        }                        
        $pdf = Pdf::loadview('dashboard.laporan.pemasukan.layouts.print.print_transaksi_pemasukan', [
            'data' => $transaksi->get(),
            'pemasukan' => $transaksi->sum('jumlah'),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                    ->where('transaksis.user_id', auth()->user()->id)
                                    ->where('void', false)
                                    ->where('transaksis.jenis_transaksi_id', 1)
                                    ->distinct()
                                    ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->get(),
            'bulan' => $namaBulan,
        ]);

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function dwonlodTransaksiPengeluaran() 
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 2)
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers']);

        if(request()->id == 'all'){
            $transaksi->get();
            $namaBulan = null;
        }else{
            $transaksi->whereMonth('tanggal', request()->id);
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);
    
            $namaBulan = $tanggal->isoFormat('MMMM');
        }                        
        $pdf = Pdf::loadview('dashboard.laporan.pengeluaran.layouts.print.print_transaksi_pengeluaran', [
            'data' => $transaksi->get(),
            'pengeluaran' => $transaksi->sum('jumlah'),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                    ->where('transaksis.user_id', auth()->user()->id)
                                    ->where('void', false)
                                    ->where('transaksis.jenis_transaksi_id', 2)
                                    ->distinct()
                                    ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->get(),
            'bulan' => $namaBulan,
        ]);

        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function dwonlodLabaRugi()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                            ->where('void', false);
        $namaBulan = null;
        if(request()->id != 'all'){
            $transaksi->whereMonth('tanggal', request()->id);
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);
        
            $namaBulan = $tanggal->isoFormat('MMMM');
        }
    
        $transaksi = $transaksi->get(); // Eksekusi query dan dapatkan hasilnya
        $pdf = Pdf::loadView('dashboard.laporan.labarugi.layouts.print.index', [
            'pemasukan' => $transaksi->where('jenis_transaksi_id', 1)->sum('jumlah'),
            'pengeluaran' =>$transaksi->where('jenis_transaksi_id', 2)->sum('jumlah'),
            'pemasukanByKategori' => DatabaseHelper::getTransaksiPemasukanGroupByKategori(),
            'pengeluaranByKategori' => DatabaseHelper::getTransaksiPengeluaranGroupByKategori(),
            'user' => DatabaseHelper::getUser()[0]
        ]);

        return $pdf->setPaper('a4', 'landscape')->stream();
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
