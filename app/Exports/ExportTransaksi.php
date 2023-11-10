<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Jenis_transaksi;
use App\Models\Transaksi;
use App\Helper\DatabaseHelper;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportTransaksi implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('dashboard.transaksi.layouts.tabel_xlsx', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'transaksi' => Transaksi::with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                ->where('user_id', Auth::id())
                ->where('void', false)
                ->orderBy('created_at', 'desc')
                ->get(),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'user' => DatabaseHelper::getUser()[0],
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
    }
    
}
