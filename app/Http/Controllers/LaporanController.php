<?php

namespace App\Http\Controllers;

use App\Helper\DatabaseHelper;
use App\Models\Laporan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LDAP\Result;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaranKebutuhan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                                            ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', '=', 'kategori_anggarans.id')
                                            ->where('transaksis.user_id', auth()->user()->id)
                                            ->where('kategori_anggarans.nama', 'kebutuhan')
                                            ->groupBy('kategori_anggarans.nama', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
                                            ->select(
                                                'kategori_anggarans.nama as kategori_anggaran',
                                                'anggarans.jumlah as jumlah_anggaran',
                                                DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
                                                'transaksis.kategori_transaksi_id'
                                            )
                                            ->get();
    

        $pengeluaranKeinginan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                                ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', 'kategori_anggarans.id')
                                ->where('transaksis.user_id', auth()->user()->id)
                                ->where('kategori_anggarans.nama', 'keinginan')
                                ->groupBy('kategori_anggarans.nama', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
                                ->select(
                                    'kategori_anggarans.nama as kategori_anggaran',
                                    'anggarans.jumlah as jumlah_anggaran',
                                    DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
                                    'transaksis.kategori_transaksi_id'
                                )
                                ->get();


        $tabungan = Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 3)
                                ->select(
                                    'transaksis.kategori_transaksi_id',
                                    DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
                                    // 'transaksis.deskripsi'
                                )
                                ->groupBy('transaksis.kategori_transaksi_id')
                                ->get();                        
        
        return view('dashboard.laporan.index', [
            'pemasukan' => Transaksi::where('user_id', auth()->user()->id)
                                    ->where('jenis_transaksi_id', 1)
                                    ->select(
                                        'transaksis.kategori_transaksi_id',
                                        DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
                                    )
                                    ->groupBy('transaksis.kategori_transaksi_id')
                                    ->get(),
            'totalPemasukan' => Transaksi::where('user_id', auth()->user()->id)
                                          ->where('jenis_transaksi_id', 1)
                                          ->sum('jumlah'),
            'pengeluaranKebutuhan' => $pengeluaranKebutuhan,
            'jumlahTransaksiKebutuhan' => DatabaseHelper::getJumlahTransaksiBudgeting('kebutuhan'),
            'pengeluaranKeinginan' => $pengeluaranKeinginan,
            'jumlahTransaksiKeinginan' => DatabaseHelper::getJumlahTransaksiBudgeting('keinginan'),
            'jumlahPengeluaran' => DatabaseHelper::getJumlahPengeluaranBudgeting(),
            'tabungan' => $tabungan,
            'jumlahTabungan' => Transaksi::where('user_id', auth()->user()->id)->where('jenis_transaksi_id', 3)->sum('jumlah'),
        ]);
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
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
