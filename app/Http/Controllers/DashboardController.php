<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Jenis_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helper\DatabaseHelper;
use App\Models\Kategori_anggaran;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendapatanDanPengeluaran = DB::table('jenis_transaksis')
                                    ->leftJoinSub(function ($query) {
                                        $query->select(
                                            'transaksis.user_id',
                                            DB::raw('SUM(transaksis.jumlah) as total_saldo_1')
                                        )
                                        ->from('transaksis')
                                        ->where('user_id', auth()->user()->id)
                                        ->where('transaksis.jenis_transaksi_id', 1)
                                        ->whereMonth('created_at', DatabaseHelper::getMonth())
                                        ->groupBy('transaksis.user_id');
                                    }, 'saldo_1', function ($join) {
                                        $join->on('jenis_transaksis.id', '=', DB::raw(1));
                                    })
                                    ->leftJoinSub(function ($query) {
                                        $query->select(
                                            'transaksis.user_id',
                                            DB::raw('SUM(transaksis.jumlah) as total_saldo_2_3')
                                        )
                                        ->from('transaksis')
                                        ->where('user_id', auth()->user()->id)
                                        ->whereMonth('created_at', DatabaseHelper::getMonth())
                                        ->whereIn('transaksis.jenis_transaksi_id', [2, 3])
                                        ->groupBy('transaksis.user_id');
                                    }, 'saldo_2_3', function ($join) {
                                        $join->on('jenis_transaksis.id', '=', DB::raw(2));
                                    })
                                    ->select(
                                        'jenis_transaksis.id as jenis_transaksi_id',
                                        DB::raw('COALESCE(saldo_1.total_saldo_1, 0) as total_saldo_1'),
                                        DB::raw('COALESCE(saldo_2_3.total_saldo_2_3, 0) as total_saldo_2_3')
                                    )
                                    ->get();






        $saldo = Transaksi::join('jenis_transaksis', 'transaksis.jenis_transaksi_id', '=', 'jenis_transaksis.id')
                        ->where('transaksis.user_id', auth()->user()->id)
                        ->whereMonth('transaksis.created_at', DatabaseHelper::getMonth())
                        ->select(
                            DB::raw('SUM(CASE WHEN jenis_transaksis.id = 1 THEN transaksis.jumlah ELSE 0 END) - (SUM(CASE WHEN jenis_transaksis.id = 2 THEN transaksis.jumlah ELSE 0 END) + SUM(CASE WHEN jenis_transaksis.id = 3 THEN transaksis.jumlah ELSE 0 END)) AS saldo')
                        )
                        ->get();   




                        
        $topPengeluaran = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                    ->select('kategori_transaksi_id', 'kategori_transaksis.nama',  DB::raw('SUM(jumlah) as total_jumlah'))
                                    ->where('transaksis.user_id', auth()->user()->id)
                                    ->whereMonth('transaksis.created_at', DatabaseHelper::getMonth())
                                    ->where('transaksis.jenis_transaksi_id', 2)
                                    ->groupBy('kategori_transaksi_id')
                                    ->orderByDesc('total_jumlah')
                                    ->get();



        // Hasilnya adalah koleksi yang sudah digabungkan

                                    
        return view('dashboard.index', [
            'pendapatanDanPengeluaran' => $pendapatanDanPengeluaran,
            'saldo' => $saldo,
            'jumlahTabungan' => Transaksi::where('user_id', auth()->user()->id)->where('jenis_transaksi_id', 3)->sum('jumlah'),
            'transaksiTerkini' => Transaksi::where('user_id', auth()->user()->id)
                                            ->whereDate('created_at', now()->format('Y-m-d'))
                                            ->get(),
            'anggarans' => DatabaseHelper::getPersentaseAnggaran(),
            'topPengeluaran' => $topPengeluaran,             
            'dataBudgeting' => DatabaseHelper::getJumlahBudgeting(),
            'persentaseBudgeting' => DatabaseHelper::getPersentaseBudgeting(),
            'getBudgeting' => Kategori_anggaran::where('user_id', auth()->user()->id)->get(),
            'persentaseTabungan' => DatabaseHelper::getPersentaseTabungan()
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


    public function get_persentase()
    {
        $jumlah_pendapatan = Transaksi::where('user_id', auth()->user()->id)->
                                        where('jenis_transaksi_id', 1)
                                        ->sum('jumlah');
        $jumlah_anggaran = Anggaran::where('user_id', auth()->user()->id)->sum('jumlah');

        return [
            intval($jumlah_anggaran),
            intval( $jumlah_pendapatan) - $jumlah_anggaran,
        ];
    }

    public function get_perbandingan_pemasukan_pengeluaran()
    {
        $data_jumlah_pendapatan = Transaksi::where('user_id', auth()->user()->id)
                                            ->where('jenis_transaksi_id', 1)
                                            ->sum('jumlah');
        $data_jumlah_pengeluaran = Transaksi::where('user_id', auth()->user()->id)
                                            ->where('jenis_transaksi_id', 2)
                                            ->sum('jumlah');

        return [
            intval($data_jumlah_pengeluaran),
            intval($data_jumlah_pendapatan) - intval($data_jumlah_pengeluaran),
        ];
    }

    public function getBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
                                                ->where('kategori_transaksi_id', 1)
                                                ->sum('jumlah');


        $jumlahBudgeting = Kategori_anggaran::select(
                                                'nama',
                                                'id',
                                                DB::raw("($jumlahPendapatanTransaksi * value / 100) AS jumlah")
                                            )
                                            ->where('user_id', auth()->user()->id)
                                            ->get();

        return $jumlahBudgeting;                                    
    }
}
