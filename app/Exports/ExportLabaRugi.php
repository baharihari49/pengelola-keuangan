<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;use App\Models\Transaksi;
use App\Helper\DatabaseHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportLabaRugi implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                            ->where('void', false);
    // $namaBulan = null;
    if(request()->id != 'all'){
        $transaksi->whereMonth('tanggal', request()->id);
        // $bulanAngka = request()->id;
        // $tanggal = Carbon::create(null, $bulanAngka, 1);
    
        // $namaBulan = $tanggal->isoFormat('MMMM');
    }
    
    $transaksi = $transaksi->get(); // Eksekusi query dan dapatkan hasilnya
    
    return view('dashboard.laporan.labarugi.layouts.excel.index', [
        'pemasukan' => $transaksi->where('jenis_transaksi_id', 1)->sum('jumlah'),
        'pengeluaran' => $transaksi->where('jenis_transaksi_id', 2)->sum('jumlah'),
        'pemasukanByKategori' => DatabaseHelper::getTransaksiPemasukanGroupByKategori(),
        'pengeluaranByKategori' => DatabaseHelper::getTransaksiPengeluaranGroupByKategori(),
        'user' => DatabaseHelper::getUser()[0],
        'dataBulan' => DatabaseHelper::getMonthTransaki(),
    ]);
    }
}
