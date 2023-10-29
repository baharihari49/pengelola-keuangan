<?php

namespace App\Helper;

use App\Models\Anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori_anggaran;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class DatabaseHelper
{
    public static function getJumlahBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
                                                ->where('jenis_transaksi_id', 1)
                                                ->whereMonth('created_at', DatabaseHelper::getMonth())
                                                ->sum('jumlah');


        $jumlahBudgeting = Kategori_anggaran::select(
                                                'nama',
                                                'id',
                                                DB::raw("($jumlahPendapatanTransaksi * value / 100) AS jumlah")
                                            )
                                            ->where('user_id', auth()->user()->id)
                                            // ->whereMonth('created_at', DatabaseHelper::getMonth())
                                            ->get();

        return $jumlahBudgeting;                                    
    }

    public static function getPersentaseBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
                                                ->where('jenis_transaksi_id', 1)
                                                ->whereMonth('created_at', DatabaseHelper::getMonth())
                                                ->sum('jumlah');
                                                
        $records = DB::table('kategori_anggarans')
                    ->where('anggarans.user_id', auth()->user()->id)
                    ->leftJoin('anggarans', 'kategori_anggarans.id', '=', 'anggarans.kategori_anggaran_id')
                    ->leftJoin('transaksis', 'anggarans.kategori_transaksi_id', '=', 'transaksis.kategori_transaksi_id')
                    ->where('transaksis.user_id', auth()->user()->id)
                    ->whereMonth('transaksis.created_at', DatabaseHelper::getMonth())
                    ->select(
                        'kategori_anggarans.id AS id_kategori_anggaran',
                        'kategori_anggarans.value',
                        DB::raw('SUM(transaksis.jumlah) as total_jumlah')
                    )
                    ->groupBy('kategori_anggarans.id', 'kategori_anggarans.value')
                    ->get();
                        


        $getKategoriAnggaran = Kategori_anggaran::where('user_id', auth()->user()->id)->get();

        $persentaseBudgeting = [];

        foreach ($records as $record) {
            foreach ($getKategoriAnggaran as $gka) {
                if ($record->id_kategori_anggaran === $gka->id) {
                    $jumlahPendapatanTransaksi = intval($jumlahPendapatanTransaksi);
                    $gkaValue = intval($gka->value);

                    $persentase = ($jumlahPendapatanTransaksi && $gkaValue) 
                        ? (intval($record->total_jumlah) / ($jumlahPendapatanTransaksi * $gkaValue / 100)) * 100 
                        : 0;

                    $persentaseBudgeting[] = [
                        'nama' => $gka->nama,
                        'id' => $record->id_kategori_anggaran,
                        'persentase' => $persentase,
                    ];
                }
            }
        }


        return isset($persentaseBudgeting) ? $persentaseBudgeting : [];               
    }

    public static function getPersentaseAnggaran()
    {
        $persentaseAnggarans = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                                ->where('transaksis.user_id', auth()->user()->id)
                                ->where('anggarans.user_id', auth()->user()->id)
                                ->whereMonth('transaksis.created_at', DatabaseHelper::getMonth())
                                ->select(
                                    'anggarans.kategori_transaksi_id',
                                    DB::raw('SUM(transaksis.jumlah) / anggarans.jumlah * 100 AS persentase')
                                )
                                ->groupBy('transaksis.kategori_transaksi_id', 'anggarans.kategori_transaksi_id', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
                                ->get();


        $anggaran = Anggaran::where('user_id', auth()->user()->id)->get();

        $persentaseAnggaransArray = $persentaseAnggarans->keyBy('kategori_transaksi_id')->map(function ($item) {
            return floatval($item->persentase); // Mengonversi persentase ke float
        })->toArray();


        $anggaranDenganPersentase = $anggaran->map(function ($item) use ($persentaseAnggaransArray) {
            $kategori_transaksi_id = $item->kategori_transaksi_id;
            $persentase = $persentaseAnggaransArray[$kategori_transaksi_id] ?? 0; // Default 0 jika tidak ada persentase yang cocok
            $item->persentase = $persentase;
            return $item;
        });

        return $anggaranDenganPersentase;
        
    }

    public static function getJumlahTransaksiBudgeting($param)
    {
        $jumlahTransaksiKebutuhan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                                        ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', '=', 'kategori_anggarans.id')
                                        ->where('anggarans.user_id', auth()->user()->id)
                                        ->where('transaksis.user_id', auth()->user()->id)
                                        ->whereMonth('transaksis.created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
                                        ->where('kategori_anggarans.nama', $param)
                                        ->select(
                                            'kategori_anggarans.nama as kategori_anggaran',
                                            'anggarans.jumlah as jumlah_anggaran',
                                            DB::raw('SUM(transaksis.jumlah) as jumlah_transaksi') // Menghitung jumlah transaksi
                                        )
                                        ->groupBy('kategori_anggarans.nama', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id') // Hanya mengelompokkan berdasarkan kategori_anggaran
                                        ->get();

                                        // return $jumlahTransaksiKebutuhan;
            $groupedData = [];
                                
            foreach ($jumlahTransaksiKebutuhan as $item) {
                $kategori = $item["kategori_anggaran"];
                                
                                            // Jika kategori_anggaran belum ada dalam array groupedData, inisialisasi dengan nilai awal
                if (!isset($groupedData[$kategori])) {
                    $groupedData[$kategori] = [
                        "kategori_anggaran" => $kategori,
                        "jumlah_anggaran" => 0,
                        "jumlah_transaksi" => 0,
                        "selisih" => 0,
                    ];
                }
                                
                // Menjumlahkan nilai jumlah_anggaran dan jumlah_transaksi
                $groupedData[$kategori]["jumlah_anggaran"] += $item["jumlah_anggaran"];
                $groupedData[$kategori]["jumlah_transaksi"] += intval($item["jumlah_transaksi"]);
                                
                // Menghitung selisih
                $groupedData[$kategori]["selisih"] = $groupedData[$kategori]["jumlah_anggaran"] - $groupedData[$kategori]["jumlah_transaksi"];
            };                                    
            return array_values($groupedData);
    }

    public static function getJumlahPengeluaranBudgeting()
    {
        $jumlahAnggaran = Anggaran::where('user_id', auth()->user()->id)->sum('jumlah');


        $jumlahTransaksi = Transaksi::where('user_id', auth()->user()->id)->whereMonth('created_at', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))->where('jenis_transaksi_id', 2)->sum('jumlah');

        return [
            'jumlah_anggaran' => $jumlahAnggaran,
            'jumlah_transaksi' => $jumlahTransaksi,
            'selisih' => $jumlahAnggaran - $jumlahTransaksi
        ];
    }

    public static function getPersentaseTabungan()
    {
        $userId = auth()->user()->id;

        $jumlahPendapatan = Transaksi::where('user_id', $userId)->whereMonth('created_at', DatabaseHelper::getMonth())->where('jenis_transaksi_id', 1)->sum('jumlah');
        $jumlahTabungan = Transaksi::where('user_id', $userId)->whereMonth('created_at', DatabaseHelper::getMonth())->where('jenis_transaksi_id', 3)->sum('jumlah');

        $dataTabungan = Kategori_anggaran::where('user_id', $userId)->where('nama', 'tabungan')->value('value');

        // // Debugging: Cetak nilai variabel
        // var_dump($jumlahPendapatan, $jumlahTabungan, $dataTabungan);

        // exit();

        $persentase = 0; // Inisialisasi dengan 0

        if ($dataTabungan !== 0 && $dataTabungan !== null && $jumlahPendapatan !== 0 && $jumlahTabungan !== 0) {
            $persentase = ($jumlahTabungan / ($dataTabungan / 100 * $jumlahPendapatan)) * 100;
        }

        return $persentase;

    }

    public static function getMonth()
    {
        // Mengatur zona waktu menjadi "Asia/Jakarta"
        $tanggalSaatIni = Carbon::now();

        // Mengatur zona waktu "Asia/Jakarta"
        $tanggalSaatIni->setTimezone('Asia/Jakarta');
        
        // Format tanggal sesuai dengan kebutuhan Anda
        $tanggalSaatIniFormatted = $tanggalSaatIni->format('Y-m-d H:i:s');

        // Mendapatkan bulan saat ini dalam bentuk nomor (1-12)
        return $tanggalSaatIni->month;

    }

    public static function getYear()
    {
        // Mengatur zona waktu menjadi "Asia/Jakarta"
        $tanggalSaatIni = Carbon::now();

        // Mengatur zona waktu "Asia/Jakarta"
        $tanggalSaatIni->setTimezone('Asia/Jakarta');
        
        // Format tanggal sesuai dengan kebutuhan Anda
        $tanggalSaatIniFormatted = $tanggalSaatIni->format('Y-m-d H:i:s');

        // Mendapatkan bulan saat ini dalam bentuk nomor (1-12)
        return $tanggalSaatIni->year;

    }

    public static function getMonthTransaki()
    {
        return Transaksi::where('user_id', auth()->user()->id)
                            ->selectRaw('DATE_FORMAT(created_at, "%M") as bulan_transaksi')
                            ->selectRaw('DATE_FORMAT(created_at, "%m") as id_bulan')
                            ->distinct()
                            ->get();

    }

    public static function getDate() 
    {
        App::setLocale('id');

        $date = Carbon::now(); // Mengambil tanggal dan waktu saat ini
        $formattedDate = $date->isoFormat('dddd D MMMM YYYY'); // Format dalam bahasa Indonesia
        // $formattedDate = str_replace(['siang', 'malam'], ['AM', 'PM'], $formattedDate); // Mengganti "siang" dengan "AM" dan "malam" dengan "PM"

        return $formattedDate;
    }

    public static function getTime() 
    {App::setLocale('id');

        $date = Carbon::now(); // Mengambil tanggal dan waktu saat ini
        $formattedTime = $date->format('H:i A'); // Format waktu dalam format 24 jam (misalnya, "00:55")

        return $formattedTime;
    }

    public static function getDay()
    {
        App::setLocale('id');

        $date = Carbon::now(); // Mengambil tanggal dan waktu saat ini
        $formattedDate = $date->isoFormat('A'); // Format dalam bahasa Indonesia

        return $formattedDate;
    }

    public static function getUser()
    {
        return User::where('id', auth()->user()->id)->get();
    }
}
