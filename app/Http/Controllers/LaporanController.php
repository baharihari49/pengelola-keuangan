<?php

namespace App\Http\Controllers;

use App\Exports\ExportLabaRugi;
use App\Exports\ExportPemasukan;
use App\Exports\ExportPengeluaran;
use App\Helper\DatabaseHelper;
use App\Models\Kategori_transaksi;
use App\Models\Laporan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
            'pemasukan' => DatabaseHelper::getPendapatan(),
            'data' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                ->where('transaksis.user_id', auth()->user()->id)
                ->whereIn('transaksis.jenis_transaksi_id', [1, 2])
                ->whereIn('kategori_transaksis.jenis_transaksi_id', [1, 2])
                ->where('void', false)
                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                ->paginate(15),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                ->where('transaksis.user_id', auth()->user()->id)
                ->where('void', false)
                ->whereIn('transaksis.jenis_transaksi_id', [1, 2])
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
            'data' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                ->where('transaksis.user_id', auth()->user()->id)
                                ->whereIn('transaksis.jenis_transaksi_id', [3,4])
                                ->whereIn('kategori_transaksis.jenis_transaksi_id', [3,4])
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                                ->paginate(15),
            'pengeluaran' => Transaksi::where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [3, 4])
                ->where('void', false)
                ->sum('jumlah'),
            'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                ->where('transaksis.user_id', auth()->user()->id)
                ->where('void', false)
                ->whereIn('transaksis.jenis_transaksi_id', [3, 4])
                ->distinct()
                ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
                ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
                ->get(),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    public function showLaporanLabaRugi()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
            ->where('void', false);
        $namaBulan = null;


        $labaRugi = Transaksi::join('jenis_transaksis', 'transaksis.jenis_transaksi_id', '=', 'jenis_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('transaksis.void', false)
            ->select(
                DB::raw('SUM(CASE WHEN jenis_transaksis.id IN (1,2) THEN transaksis.jumlah ELSE 0 END) - (SUM(CASE WHEN jenis_transaksis.id IN (3,4) THEN transaksis.jumlah ELSE 0 END) + SUM(CASE WHEN jenis_transaksis.id = 5 THEN transaksis.jumlah ELSE 0 END)) AS saldo')
            )
            ->get();

        if (request()->id != 'all') {
            $transaksi->whereMonth('tanggal', request()->id);
            $bulanAngka = request()->id;
            $tanggal = Carbon::create(null, $bulanAngka, 1);

            $namaBulan = $tanggal->isoFormat('MMMM');

            $labaRugi = Transaksi::join('jenis_transaksis', 'transaksis.jenis_transaksi_id', '=', 'jenis_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('transaksis.void', false)
            ->whereMonth('tanggal', request()->id)
            ->select(
                DB::raw('SUM(CASE WHEN jenis_transaksis.id IN (1,2) THEN transaksis.jumlah ELSE 0 END) - (SUM(CASE WHEN jenis_transaksis.id IN (3,4) THEN transaksis.jumlah ELSE 0 END) + SUM(CASE WHEN jenis_transaksis.id = 5 THEN transaksis.jumlah ELSE 0 END)) AS saldo')
            )
            ->get();
        }

        $transaksi = $transaksi->get(); // Eksekusi query dan dapatkan hasilnya



        return view('dashboard.laporan.labarugi.index', [
            'pemasukan' => $transaksi->whereIn('jenis_transaksi_id', [1, 2])->sum('jumlah'),
            'pengeluaran' => $transaksi->whereIn('jenis_transaksi_id', [3, 4])->sum('jumlah'),
            'pemasukanByKategori' => DatabaseHelper::getTransaksiPemasukanGroupByKategori(),
            'pengeluaranByKategori' => DatabaseHelper::getTransaksiPengeluaranGroupByKategori(),
            'user' => DatabaseHelper::getUser()[0],
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'bulan' => $namaBulan,
            'labaRugi' => $labaRugi
        ]);
    }

    public function pemasukanExcel()
    {
        return Excel::download(new ExportPemasukan, 'laporan pemasukan.xlsx');
    }

    public function pengeluaranExcel()
    {
        return Excel::download(new ExportPengeluaran, 'laporan pengeluaran.xlsx');
    }

    public function labaRugiExcel()
    {
        return Excel::download(new ExportLabaRugi, 'Laporan Laba Rugi.xlsx');
    }

    public function getTransaksiByKategori()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
            ->where('user_id', auth()->user()->id)
            ->where('void', false);

            $jenisTransaksiId = request()->jenis_transaksi_id;

            if ($jenisTransaksiId == 1) {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [1, 2]);
            } elseif ($jenisTransaksiId == 3) {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [3, 4]);
            } else if($jenisTransaksiId == 1 && request()->id == 'all') {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [1, 2])->get();
            } else if($jenisTransaksiId == 1 && request()->id == 'all') {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [3, 4])->get();
            }


        if (request()->id == 'all') {
            $transaksi = $transaksi->get();
        } else {
            $transaksi = $transaksi->where('kategori_transaksi_id', request()->id)->get();
        }

        $transaksiFinal = [];
        foreach ($transaksi as $item) {
            $transaksiFinal[] = [
                'no_transaksi' => $item->no_transaksi,
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori_transaksi->nama,
                'supplier' => $item->suppliers_or_customers->nama_bisnis ?? '--',
                'deskripsi' => $item->deskripsi ?? '--',
                'jumlah' => number_format($item->jumlah, 0, '.', ',')
            ];
        }

        return $transaksiFinal;
    }

    public function getTransaksiByMonth()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
            ->where('user_id', auth()->user()->id)
            ->where('void', false);

        if (request()->id == 'all') {
            $transaksi = $transaksi->whereIn('jenis_transaksi_id', [1,2]);
        } else if(request()->jenis_transaksi_id == 1) {
            $transaksi->whereIn('jenis_transaksi_id', [1,2])->whereMonth('tanggal', request()->id);
        }else if(request()->jenis_transaksi_id == 3) {
            $transaksi->whereIn('jenis_transaksi_id', [3,4])->whereMonth('tanggal', request()->id);
        }


        $transaksiFinal = [];
        foreach ($transaksi->get() as $item) {
            $transaksiFinal[] = [
                'no_transaksi' => $item->no_transaksi,
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori_transaksi->nama,
                'supplier' => $item->suppliers_or_customers->nama_bisnis ?? '--',
                'deskripsi' => $item->deskripsi ?? '--',
                'jumlah' => number_format($item->jumlah, 0, '.', ',')
            ];
        }

        return $transaksiFinal;
    }

    public function getJumlahTransaksiByMonh()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
                            ->where('user_id', auth()->user()->id)
                            ->where('void', false);

        if (request()->id == 'all') {
            $transaksi = $transaksi->whereIn('jenis_transaksi_id', [1,2])->get();
        } else if(request()->jenis_transaksi_id == 1) {
            $transaksi->whereIn('jenis_transaksi_id', [1,2])->whereMonth('tanggal', request()->id)->get();
        }else if(request()->jenis_transaksi_id == 3) {
            $transaksi->whereIn('jenis_transaksi_id', [3,4])->whereMonth('tanggal', request()->id)->get();
        }

        return number_format($transaksi->sum('jumlah'), 0, ',', '.');

    }

    public function getJumlahTransaksiByKategori()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
            ->where('user_id', auth()->user()->id)
            ->where('void', false);

            $jenisTransaksiId = request()->jenis_transaksi_id;

            if ($jenisTransaksiId == 1) {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [1, 2]);
            } elseif ($jenisTransaksiId == 3) {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', [3, 4]);
            } else {
                $transaksi = $transaksi->whereIn('jenis_transaksi_id', []);
            }


        if (request()->id == 'all') {
            $transaksi = $transaksi->get();
        } else {
            $transaksi = $transaksi->where('kategori_transaksi_id', request()->id)->get();
        }

        return number_format($transaksi->sum('jumlah'), 0, ',', '.');

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
