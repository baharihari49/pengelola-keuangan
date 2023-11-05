<?php

namespace App\Http\Controllers;

use App\Helper\DatabaseHelper;
use App\Models\Kategori_transaksi;
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
    // public function index()
    // {
    //     $pengeluaranKebutuhan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
    //                                         ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', '=', 'kategori_anggarans.id')
    //                                         ->where('transaksis.user_id', auth()->user()->id)
    //                                         ->where('anggarans.user_id', auth()->user()->id)
    //                                         ->whereMonth('transaksis.created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                                         ->where('kategori_anggarans.nama', 'kebutuhan')
    //                                         ->groupBy('kategori_anggarans.nama', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
    //                                         ->select(
    //                                             'kategori_anggarans.nama as kategori_anggaran',
    //                                             'anggarans.jumlah as jumlah_anggaran',
    //                                             DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
    //                                             'transaksis.kategori_transaksi_id'
    //                                         )
    //                                         ->get();
    
    //     $pengeluaranKeinginan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
    //                             ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', 'kategori_anggarans.id')
    //                             ->where('transaksis.user_id', auth()->user()->id)
    //                             ->where('anggarans.user_id', auth()->user()->id)
    //                             ->whereMonth('transaksis.created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                             ->where('kategori_anggarans.nama', 'keinginan')
    //                             ->groupBy('kategori_anggarans.nama', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
    //                             ->select(
    //                                 'kategori_anggarans.nama as kategori_anggaran',
    //                                 'anggarans.jumlah as jumlah_anggaran',
    //                                 DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
    //                                 'transaksis.kategori_transaksi_id'
    //                             )
    //                             ->get();


    //     $tabungan = Transaksi::where('user_id', auth()->user()->id)
    //                             ->where('jenis_transaksi_id', 3)
    //                             ->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                             ->select(
    //                                 'transaksis.kategori_transaksi_id',
    //                                 DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
    //                                 // 'transaksis.deskripsi'
    //                             )
    //                             ->groupBy('transaksis.kategori_transaksi_id')
    //                             ->get();          
                                
        
    //     return view('dashboard.laporan.index', [
    //         'pemasukan' => Transaksi::where('user_id', auth()->user()->id)
    //                                 ->where('jenis_transaksi_id', 1)
    //                                 ->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                                 ->select(
    //                                     'transaksis.kategori_transaksi_id',
    //                                     DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi'),
    //                                 )
    //                                 ->groupBy('transaksis.kategori_transaksi_id')
    //                                 ->get(),
    //         'totalPemasukan' => Transaksi::where('user_id', auth()->user()->id)
    //                                 ->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                                 ->where('jenis_transaksi_id', 1)
    //                                       ->sum('jumlah'),
    //         'pengeluaranKebutuhan' => $pengeluaranKebutuhan,
    //         'jumlahTransaksiKebutuhan' => DatabaseHelper::getJumlahTransaksiBudgeting('kebutuhan'),
    //         'pengeluaranKeinginan' => $pengeluaranKeinginan,
    //         'jumlahTransaksiKeinginan' => DatabaseHelper::getJumlahTransaksiBudgeting('keinginan'),
    //         'jumlahPengeluaran' => DatabaseHelper::getJumlahPengeluaranBudgeting(),
    //         'tabungan' => $tabungan,
    //         'jumlahTabungan' => Transaksi::where('user_id', auth()->user()->id)->where('jenis_transaksi_id', 3)
    //                         ->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                         ->sum('jumlah'),
    //         'dataBulan' => DatabaseHelper::getMonthTransaki(),
    //         'bulanSaatIni' => Transaksi::where('user_id', auth()->user()->id)
    //                         ->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
    //                         ->selectRaw('DATE_FORMAT(created_at, "%M") as bulan_transaksi')
    //                         ->selectRaw('DATE_FORMAT(created_at, "%m") as id_bulan')
    //                         ->distinct()
    //                         ->get(),
    //         'user' => DatabaseHelper::getUser()[0],
    //     ]);
    // }

    public function showLaporanPemasukan()
    {
       
        return view('dashboard.laporan.pemasukan.index', [
            'data' => Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 1)
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                                ->get(),
            'pemasukan' => Transaksi::where('user_id', auth()->user()->id)
                                    ->where('jenis_transaksi_id', 1)
                                    ->where('void', false)
                                    ->sum('jumlah'),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                    ->where('transaksis.user_id', auth()->user()->id)
                                    ->where('void', false)
                                    ->where('transaksis.jenis_transaksi_id', 1)
                                    ->distinct()
                                    ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->get(),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    public function showLaporanPengeluaran()
    {
        return view('dashboard.laporan.pengeluaran.index', [
            'data' => Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 2)
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                                ->get(),
            'pengeluaran' => Transaksi::where('user_id', auth()->user()->id)
                                    ->where('jenis_transaksi_id', 2)
                                    ->where('void', false)
                                    ->sum('jumlah'),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                    ->where('transaksis.user_id', auth()->user()->id)
                                    ->where('void', false)
                                    ->where('transaksis.jenis_transaksi_id', 2)
                                    ->distinct()
                                    ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
                                    ->get(),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    public function getTransaksiByKategori()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
                            ->where('user_id', auth()->user()->id)
                            ->where('jenis_transaksi_id', request()->jenis_transaksi_id);
    
    if (request()->id == 'all') {
        $transaksi = $transaksi->get();
    } else {
        $transaksi = $transaksi->where('kategori_transaksi_id', request()->id)->get();
    }
    
        $transaksiFinal = [];
        foreach($transaksi as $item) {
            $transaksiFinal[] = [
                'no_transaksi' => $item->no_transaksi,
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori_transaksi->nama,                
                'supplier' => $item->suppliers_or_customers->nama_bisnis ?? '--',
                'deskripsi' => $item->deskripsi ?? '--',
                'jumlah' => number_format($item->jumlah, 0 ,'.', ',')
            ];
        }

        return $transaksiFinal;
    }

    public function getTransaksiByMonth()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
                            ->where('user_id', auth()->user()->id)
                            ->where('jenis_transaksi_id', request()->jenis_transaksi_id);
    
        if (request()->id == 'all') {
            $transaksi = $transaksi->get();
        } else {
            $transaksi = $transaksi->whereMonth('created_at', request()->id)->get();
        }
        $transaksiFinal = [];
        foreach($transaksi as $item) {
            $transaksiFinal[] = [
                'no_transaksi' => $item->no_transaksi,
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori_transaksi->nama,                
                'supplier' => $item->suppliers_or_customers->nama_bisnis ?? '--',
                'deskripsi' => $item->deskripsi ?? '--',
                'jumlah' => number_format($item->jumlah, 0 ,'.', ',')
            ];
        }

        return $transaksiFinal;
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
