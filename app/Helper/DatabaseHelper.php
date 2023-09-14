<?php

namespace App\Helper;

use App\Models\Anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori_anggaran;

class DatabaseHelper
{
    public static function getJumlahBudgeting()
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

    public static function getPersentaseBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
                                                ->where('kategori_transaksi_id', 1)
                                                ->sum('jumlah');
                                                
        // $records = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
        //                     ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', '=', 'kategori_anggarans.id')
        //                     ->select(
        //                         'transaksis.kategori_transaksi_id',
        //                         'anggarans.kategori_anggaran_id',
        //                         'kategori_anggarans.id AS id_kategori_anggaran',
        //                         'kategori_anggarans.value',
        //                         DB::raw('SUM(transaksis.jumlah) AS total_jumlah')
        //                     )
        //                     ->groupBy('transaksis.kategori_transaksi_id', 'anggarans.kategori_anggaran_id', 'kategori_anggarans.id')
        //                     ->get();

        $records = DB::table('kategori_anggarans')
                    ->leftJoin('anggarans', 'kategori_anggarans.id', '=', 'anggarans.kategori_anggaran_id')
                    ->leftJoin('transaksis', 'anggarans.kategori_transaksi_id', '=', 'transaksis.kategori_transaksi_id')
                    ->select(
                        'kategori_anggarans.id AS id_kategori_anggaran',
                        'kategori_anggarans.value',
                        DB::raw('SUM(transaksis.jumlah) as total_jumlah')
                    )
                    ->groupBy('kategori_anggarans.id', 'kategori_anggarans.value')
                    ->get();
                        


        $getKategoriAnggaran = Kategori_anggaran::where('user_id', auth()->user()->id)->get();

        foreach($records as $record){
            foreach($getKategoriAnggaran as $gka) {
                if($record->id_kategori_anggaran === $gka->id){
                    $persentaseBudgeting [] = [
                        'nama' => $gka->nama,
                        'id' => $record->id_kategori_anggaran,
                        'persentase' => intval($record->total_jumlah) / (intval($jumlahPendapatanTransaksi) * intval($gka->value) / 100) * 100,
                    ];
                };
            }
        }
        return isset($persentaseBudgeting) ? $persentaseBudgeting : [];               
    }

    public static function getPersentaseAnggaran()
    {
        $persentaseAnggarans = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                                ->select(
                                    'anggarans.kategori_transaksi_id',
                                    DB::raw('SUM(transaksis.jumlah) / anggarans.jumlah * 100 AS persentase')
                                )
                                ->groupBy('transaksis.kategori_transaksi_id', 'anggarans.kategori_transaksi_id', 'anggarans.jumlah')
                                ->get();

        return $persentaseAnggarans;
    }
}
