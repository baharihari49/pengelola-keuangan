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
        $saldo = Transaksi::join('jenis_transaksis', 'transaksis.jenis_transaksi_id', '=', 'jenis_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('transaksis.void', false)
            ->select(
                DB::raw('SUM(CASE WHEN jenis_transaksis.id IN (1,2) THEN transaksis.jumlah ELSE 0 END) - (SUM(CASE WHEN jenis_transaksis.id IN (3,4) THEN transaksis.jumlah ELSE 0 END) + SUM(CASE WHEN jenis_transaksis.id = 5 THEN transaksis.jumlah ELSE 0 END)) AS saldo')
            )
            ->get();






        $topPengeluaran = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
            ->select('kategori_transaksi_id', 'kategori_transaksis.nama',  DB::raw('SUM(jumlah) as total_jumlah'))
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->whereMonth('transaksis.created_at', DatabaseHelper::getMonth())
            ->whereIn('transaksis.jenis_transaksi_id', [3, 4])
            ->groupBy('kategori_transaksi_id', 'kategori_transaksis.nama')
            ->orderByDesc('total_jumlah')
            ->get();



        // Hasilnya adalah koleksi yang sudah digabungkan


        return view('dashboard.index', [
            'pendapatan' => Transaksi::where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [1, 2])
                ->where('void', false)
                ->sum('jumlah'),
            'pendapatan_bulan_ini' => Transaksi::where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [1, 2])
                ->where('void', false)
                ->whereMonth('tanggal', DatabaseHelper::getMonth())
                ->sum('jumlah'),
            'pengeluaran' => Transaksi::where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [3, 4])
                ->where('void', false)
                ->sum('jumlah'),
            'saldo' => $saldo,
            'jumlahTabungan' => Transaksi::where('user_id', auth()->user()->id)->where('jenis_transaksi_id', 5)->where('void', false)->sum('jumlah'),
            'transaksiTerkini' => Transaksi::where('user_id', auth()->user()->id)
                ->where('void', false)
                ->whereDate('tanggal', now()->format('Y-m-d'))
                ->paginate(7),
            'anggarans' => DatabaseHelper::getPersentaseAnggaran(),
            'topPengeluaran' => $topPengeluaran,
            'dataBudgeting' => DatabaseHelper::getJumlahBudgeting(),
            'persentaseBudgeting' => DatabaseHelper::getPersentaseBudgeting(),
            'getBudgeting' => Kategori_anggaran::where('user_id', auth()->user()->id)->get(),
            'persentaseTabungan' => DatabaseHelper::getPersentaseTabungan(),
            'user' => DatabaseHelper::getUser()[0],
            'date' => DatabaseHelper::getDate(),
            'time' => DatabaseHelper::getTime(),
            'day' => DatabaseHelper::getDay()
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
        $jumlah_pendapatan = Transaksi::join('jenis_transaksis', 'transaksis.jenis_transaksi_id', '=', 'jenis_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->select(
                DB::raw('SUM(CASE WHEN jenis_transaksis.id IN (1,2) THEN transaksis.jumlah ELSE 0 END) - (SUM(CASE WHEN jenis_transaksis.id IN (3,4) THEN transaksis.jumlah ELSE 0 END) + SUM(CASE WHEN jenis_transaksis.id = 3 THEN transaksis.jumlah ELSE 0 END)) AS saldo')
            )
            ->get();

        $jumlah_anggaran = Anggaran::where('user_id', auth()->user()->id)
            ->sum('jumlah');


        // return $jumlah_pendapatan[0]['saldo'];
        return [
            intval($jumlah_anggaran),
            intval($jumlah_pendapatan[0]['saldo'])
        ];
    }

    public function get_perbandingan_pemasukan_pengeluaran()
    {
        $data_jumlah_pendapatan = Transaksi::where('user_id', auth()->user()->id)
            ->whereIn('jenis_transaksi_id', [1, 2])
            ->where('void', false)
            ->whereMonth('tanggal', DatabaseHelper::getMonth())
            ->sum('jumlah');
        $data_jumlah_pengeluaran = Transaksi::where('user_id', auth()->user()->id)
            ->whereIn('jenis_transaksi_id', [3, 4])
            ->where('void', false)
            ->whereMonth('tanggal', DatabaseHelper::getMonth())
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
