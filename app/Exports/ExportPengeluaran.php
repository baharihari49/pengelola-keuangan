<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Transaksi;
use App\Helper\DatabaseHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPengeluaran implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
         $transaksi = Transaksi::where('user_id', auth()->user()->id)
                                ->where('jenis_transaksi_id', 2)
                                ->where('void', false)
                                ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers']);


        if(request()->id == 'all'){
            $transaksi->get();
        }else{
            $transaksi->whereMonth('tanggal', request()->id)->get();
        }              
        
        
       
        
        
        return view('dashboard.laporan.pengeluaran.layouts.excel.index', [
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
        ]);
    }
}
