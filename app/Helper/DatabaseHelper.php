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
use GuzzleHttp;
use Illuminate\Support\Facades\Auth;
// use Psy\Util\Str

class DatabaseHelper
{
    public static function getPendapatan()
    {

        $transaksi = Transaksi::where('user_id', auth()->user()->id)
            ->whereIn('jenis_transaksi_id', [1, 2])
            ->where('void', false)
            ->sum('jumlah');

        return $transaksi;
    }
    public static function getJumlahBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
            ->whereIn('jenis_transaksi_id', [1, 2])
            ->where('void', false)
            ->whereMonth('tanggal', DatabaseHelper::getMonth())
            ->sum('jumlah');


        $jumlahBudgeting = Kategori_anggaran::select(
            'nama',
            'id',
            DB::raw("($jumlahPendapatanTransaksi * value / 100) AS jumlah")
        )
            ->where('user_id', auth()->user()->id)
            // ->whereMonth('tanggal', DatabaseHelper::getMonth())
            ->get();

        return $jumlahBudgeting;
    }

    public static function getPersentaseBudgeting()
    {
        $jumlahPendapatanTransaksi = Transaksi::where('user_id', auth()->user()->id)
            ->whereIn('jenis_transaksi_id', [1, 2])
            ->where('void', false)
            ->whereMonth('tanggal', DatabaseHelper::getMonth())
            ->sum('jumlah');

        $records = DB::table('kategori_anggarans')
            ->where('anggarans.user_id', auth()->user()->id)
            ->leftJoin('anggarans', 'kategori_anggarans.id', '=', 'anggarans.kategori_anggaran_id')
            ->leftJoin('transaksis', 'anggarans.kategori_transaksi_id', '=', 'transaksis.kategori_transaksi_id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('transaksis.void', false)
            ->whereMonth('transaksis.tanggal', DatabaseHelper::getMonth())
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

    public static function getPersentaseAnggaran($string)
    {

        $persentaseAnggarans = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('transaksis.void', false)
            ->where('anggarans.user_id', auth()->user()->id)
            ->whereMonth('transaksis.tanggal', DatabaseHelper::getMonth())
            ->select(
                'anggarans.kategori_transaksi_id',
                DB::raw('SUM(transaksis.jumlah) / anggarans.jumlah * 100 AS persentase')
            )
            ->groupBy('transaksis.kategori_transaksi_id', 'anggarans.kategori_transaksi_id', 'anggarans.jumlah', 'transaksis.kategori_transaksi_id')
            ->get();


            $anggaran = Anggaran::whereHas('kategori_anggaran', function ($query) use ($string) {
                $query->where('nama', $string);
            })
            ->where('user_id', auth()->user()->id)
            ->with('kategori_anggaran')
            ->get();


            // return $anggaran;

        // foreach($anggaran as $item){
        //     if($item->kategori_anggaran->nama == 'kebutuhan'){

        //     }
        // }

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
    public static function getPersentasePerbandinganDaily()
    {
        $getId = auth()->user()->id;
        $getYesterday = Carbon::today()->format('Y-m-d');
        $getMinusTwoDay = Carbon::yesterday()->format('Y-m-d');
        $getTotalPendapatanYesterday = Transaksi::where('tanggal', $getYesterday)->where('jenis_transaksi_id', [1, 2])->where('user_id', $getId)->where('void', false)->select(
            'jumlah'
        )
            ->sum('jumlah');
        $getTotalPendapatanMinusTwoDay = Transaksi::where('tanggal', $getMinusTwoDay)->where('jenis_transaksi_id', [1, 2])->where('user_id', $getId)->where('void', false)->select('jumlah')->sum('jumlah');
        $getTotalPengeluaranYesterday = Transaksi::where('tanggal', $getYesterday)->where('jenis_transaksi_id', [3, 4])->where('user_id', $getId)->where('void', false)->select('jumlah')->sum('jumlah');
        $getTotalPengeluaranMinusTwoDay = Transaksi::where('tanggal', $getMinusTwoDay)->where('jenis_transaksi_id', [3, 4])->where('user_id', $getId)->where('void', false)->select('jumlah')->sum('jumlah');
        $getSaldoYesterday = $getTotalPendapatanYesterday - $getTotalPengeluaranYesterday;
        $getSaldoMinusTwoDay = $getTotalPendapatanMinusTwoDay - $getTotalPengeluaranMinusTwoDay;
        $getSelisihPendapatan = ($getTotalPendapatanYesterday - $getTotalPendapatanMinusTwoDay);
        $persentaseSelisihPendapatan = $getTotalPendapatanMinusTwoDay > 0 ? round(($getSelisihPendapatan / $getTotalPendapatanMinusTwoDay) * 100, 2) : 0;
        $getSelisihPengeluaran = ($getTotalPengeluaranYesterday - $getTotalPengeluaranMinusTwoDay);
        $persentaseSelisihPengeluaran = $getTotalPengeluaranMinusTwoDay > 0 ? round(($getSelisihPengeluaran / $getTotalPengeluaranMinusTwoDay) * 100, 2) : 0;
        $getSelisihSaldo = ($getSaldoYesterday - $getSaldoMinusTwoDay);
        $persentaseSelisihSaldo = $getSaldoMinusTwoDay > 0 ? round(($getSelisihSaldo / $getSaldoMinusTwoDay) * 100, 2) : 0;

        // Hitung perbandingan pendapatan dari bulan lalu ke bulan tanggal berjalan sekarang
        $tanggalAwalBulanLalu = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $tanggalAkhirBulanLalu = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();
        $tanggalAwalBulan = Carbon::now()->startOfMonth()->toDateString();
        $tanggalSekarang = Carbon::now()->toDateString();
        $getTotalPendapatanBulanLalu = Transaksi::whereBetween('tanggal', [$tanggalAwalBulanLalu, $tanggalAkhirBulanLalu])->where('jenis_transaksi_id', [1, 2])->where('user_id', $getId)->where('void', false)->select('jumlah')->sum('jumlah');
        $getTotalPendapatanBulanBerjalan = Transaksi::whereBetween('tanggal', [$tanggalAwalBulan, $tanggalSekarang])->where('jenis_transaksi_id', [1, 2])->where('user_id', $getId)->where('void', false)->select('jumlah')->sum('jumlah');
        $persentaseSelisihPendapatBulanBerjalan = $getTotalPendapatanBulanLalu > 0 ? round((($getTotalPendapatanBulanBerjalan - $getTotalPendapatanBulanLalu) / $getTotalPendapatanBulanLalu) * 100, 2) : 0;
        return [
            'today' => Carbon::now()->format('Y-m-d'),
            'yesterday' => $getYesterday,
            'twoDaysBeforeToday' => $getMinusTwoDay,
            'getTotalPendapatanYesterday' => $getTotalPendapatanYesterday,
            'getTotalPendapatanMinusTwoDay' => $getTotalPendapatanMinusTwoDay,
            'getSelisihPendapatan' => $getSelisihPendapatan,
            'persentaseSelisihPendapatan' => $persentaseSelisihPendapatan,
            'getTotalPengeluaranYesterday' => $getTotalPengeluaranYesterday,
            'getTotalPengeluaranMinusTwoDay' => $getTotalPengeluaranMinusTwoDay,
            'getSelisihPengeluaran' => $getSelisihPengeluaran,
            'persentaseSelisihPengeluaran' => $persentaseSelisihPengeluaran,
            'getSaldoYesterday' => $getSaldoYesterday,
            'getSaldoMinusTwoDay' => $getSaldoMinusTwoDay,
            'persentaseSelisihSaldo' => $persentaseSelisihSaldo,
            'persentaseSelisihPendapatBulanBerjalan' => $persentaseSelisihPendapatBulanBerjalan
        ];
    }

    public static function getJumlahTransaksiBudgeting($param)
    {
        $jumlahTransaksiKebutuhan = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
            ->join('kategori_anggarans', 'anggarans.kategori_anggaran_id', '=', 'kategori_anggarans.id')
            ->where('anggarans.user_id', auth()->user()->id)
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->whereMonth('transaksis.tanggal', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))
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


        $jumlahTransaksi = Transaksi::where('user_id', auth()->user()->id)->where('void', false)->whereMonth('tanggal', (isset(request()->month) ? request()->month : DatabaseHelper::getMonth()))->whereIn('jenis_transaksi_id', [3, 4])->sum('jumlah');

        return [
            'jumlah_anggaran' => $jumlahAnggaran,
            'jumlah_transaksi' => $jumlahTransaksi,
            'selisih' => $jumlahAnggaran - $jumlahTransaksi
        ];
    }

    public static function getPersentaseTabungan()
    {
        $userId = auth()->user()->id;

        $transaksi =  Transaksi::where('user_id', $userId)->where('void', false)->whereMonth('tanggal', DatabaseHelper::getMonth())->get();

        // $jumlahPendapatan = Transaksi::where('user_id', $userId)->where('void', false)->whereMonth('tanggal', DatabaseHelper::getMonth())->whereIn('jenis_transaksi_id', [1,2])->sum('jumlah');
        // $jumlahTabungan = Transaksi::where('user_id', $userId)->where('void', false)->whereMonth('tanggal', DatabaseHelper::getMonth())->where('jenis_transaksi_id', 3)->sum('jumlah');

        $jumlahPendapatan = $transaksi->whereIn('jenis_transaksi_id', [1, 2])->sum('jumlah');
        $jumlahTabungan = $transaksi->where('jenis_transaksi_id', 5)->sum('jumlah');

        $dataTabungan = Kategori_anggaran::where('user_id', $userId)->where('nama', 'Tabungan')->value('value');

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
            ->where('void', false)
            ->selectRaw('DATE_FORMAT(tanggal, "%M") as bulan_transaksi')
            ->selectRaw('DATE_FORMAT(tanggal, "%m") as id_bulan')
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
    {
        App::setLocale('id');

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

    public static function checkNewUser()
    {
        return !empty(auth()->user()->alamat) && !empty(auth()->user()->no_handphone) && !empty(auth()->user()->username);
    }

    public static function getTransaksiPemasukanGroupByKategori()
    {
        $transaksi = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->whereIn('kategori_transaksis.jenis_transaksi_id', [1, 2]);

        if (request()->id == 'all') {
            $transaksi->select('kategori_transaksis.nama', DB::raw('SUM(transaksis.jumlah) as jumlah'))
                ->groupBy('kategori_transaksis.nama', 'transaksis.kategori_transaksi_id')->whereIn('kategori_transaksis.jenis_transaksi_id', [1, 2])->get();
        } else {
            $transaksi->whereMonth('tanggal', request()->id)->select('kategori_transaksis.nama', DB::raw('SUM(transaksis.jumlah) as jumlah'))->whereIn('kategori_transaksis.jenis_transaksi_id', [1, 2])
                ->groupBy('kategori_transaksis.nama', 'transaksis.kategori_transaksi_id');
        }

        return $transaksi->get();
    }

    public static function getTransaksiPengeluaranGroupByKategori()
    {
        $transaksi = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->whereIn('transaksis.jenis_transaksi_id', [3, 4]);

        if (request()->id == 'all') {
            $transaksi->select('kategori_transaksis.nama', DB::raw('SUM(transaksis.jumlah) as jumlah'))
                ->groupBy('kategori_transaksis.nama', 'transaksis.kategori_transaksi_id')->whereIn('kategori_transaksis.jenis_transaksi_id', [3, 4])->get();
        } else {
            $transaksi->whereMonth('tanggal', request()->id)->select('kategori_transaksis.nama', DB::raw('SUM(transaksis.jumlah) as jumlah'))
                ->groupBy('kategori_transaksis.nama', 'transaksis.kategori_transaksi_id')->whereIn('kategori_transaksis.jenis_transaksi_id', [3, 4]);
        }

        return $transaksi->get();
    }

    public static function getNextMonth()
    {
        App::setLocale('id');

        $date = Carbon::now();
        $nextMonth = $date->addMonth(); // Mengambil tanggal dan waktu saat ini
        var_dump($nextMonth->toDateTimeString());
    }

    public static function getNowMonth()
    {
        App::setLocale('id');

        $date = Carbon::now();
        // $nextMonth = $date->addMonth(); // Mengambil tanggal dan waktu saat ini
        return $date->format('Y-m-d H:i:s');
    }

    public static function get10Minute()
    {
        // Set locale jika diperlukan
        App::setLocale('id');

        // Ambil tanggal dan waktu saat ini
        $date = Carbon::now();

        // Tambahkan 10 menit ke waktu saat ini
        $futureDate = $date->addMinutes(10);

        // var_dump($futureDate->toDateTimeString('YYYY-MM-DD HH:mm'));

        // return $futureDate->toDateTimeString();

        // // Format dan tampilkan waktu 10 menit ke depan
        return $futureDate->format('YYYY-MM-DD HH:mm');
    }

    public static function getSignature($payload)
    {
        $client = new GuzzleHttp\Client();
        $base_url = env('BASE_URL');
        $secret_key = env('SECRETKEY_FLIP');

        function getPrivateKey()
        {
            $private_key = env('PRIVATKEY_FLIP');

            return $private_key;
        }

        function generateSignature($payload = [])
        {
            openssl_sign(
                json_encode($payload),
                $generatedSignature,
                openssl_pkey_get_private(getPrivateKey()),
                'sha256WithRSAEncryption'
            );

            return base64_encode($generatedSignature);
        }

        $signature = generateSignature($payload);
        // $signature_acc_inq = generateSignature($payload_acc_inq);

        return $signature;
    }
    public static function getKeuanganMonthly()
    {
        function formatRupiah($number)
        {
            $rupiah = number_format($number, 2, ".", ",");
            if ($number < 0) {
                $rupiah = "-$rupiah";
            }
            return $rupiah;
        };
        $bulan_transaksi = Transaksi::where('user_id', auth()->user()->id)
            ->where('void', false)
            ->selectRaw('DATE_FORMAT(tanggal, "%m") as bulan_transaksi')
            ->groupBy('bulan_transaksi')
            ->get();
        foreach ($bulan_transaksi as $data) {
            $jumlah_pendapatan = Transaksi::whereMonth('tanggal', $data->bulan_transaksi)
                ->where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [1, 2])
                ->sum('jumlah');

            $jumlah_pengeluaran = Transaksi::whereMonth('tanggal', $data->bulan_transaksi)
                ->where('user_id', auth()->user()->id)
                ->whereIn('jenis_transaksi_id', [3, 4])
                ->sum('jumlah');
            // $numericMonth = 11; // atau 12
            $data->monthName = Carbon::createFromDate(null, intval($data->bulan_transaksi), 1)->format('F');
            $data->income = intval($jumlah_pendapatan);
            $data->outcome = intval($jumlah_pengeluaran);
            $data->saldo = intval(($jumlah_pendapatan - $jumlah_pengeluaran));
        }

        return response()->json($bulan_transaksi);
        // $incomeMonthly = Transaksi::where('')
    }

    public static function getValueAnggaran($index, $id)
    {
        // $anggaran = Anggaran::where('user_id', auth()->user()->id)->where('jenis_transaksi_id')->where('adjust', 'yes')->count() ?? 0;

        $anggaran = Anggaran::whereHas('kategori_transaksi', function ($query) use ($id) {
            $query->where('jenis_transaksi_id', $id);
        })
        ->where('user_id', auth()->user()->id)
        ->where('adjust', 'yes');

        $countAnggaran = $anggaran->count() ?? 0;
        $jumlahAnggaran = $anggaran->sum('jumlah') ?? 0;

        $jumlahKebutuhan = intval( DatabaseHelper::getJumlahBudgeting()[$index]->jumlah - $jumlahAnggaran);
        $countKategoriTransaksi = Kategori_transaksi::where('jenis_transaksi_id', $id)->count() - $countAnggaran;

        // return $countKategoriTransaksi;

        $nilaiAnggaran = floor( $jumlahKebutuhan/$countKategoriTransaksi);
        return $nilaiAnggaran;
    }


    public static function updateAnggaran($index, $id)
    {
        $kategoriTransaksi = Kategori_transaksi::where('jenis_transaksi_id', $id)->get();


        $kategoriAnggaranId = DatabaseHelper::getJumlahBudgeting()[$index]->id;

        $nilaiAnggaran = [];

        foreach ($kategoriTransaksi as $i => $item) {
            $nilaiAnggaran[] = [
                'upsert_id' => intval($i + 1) . intval($item->id) . intval(auth()->user()->id),
                'kategori_transaksi_id' => $item->id,
                'jumlah' => DatabaseHelper::getValueAnggaran($index, $id),
                'user_id' => auth()->user()->id,
                'kategori_anggaran_id' => $kategoriAnggaranId,
            ];
        }

        // return $nilaiAnggaran;


        Anggaran::upsert(
            $nilaiAnggaran,
            ['upsert_id'], // Kunci untuk menentukan baris yang sudah ada
            ['jumlah']  // Kolom-kolom yang akan di-update atau di-insert
        );

        $anggaran = Anggaran::whereHas('kategori_transaksi', function ($query) use ($id) {
            $query->where('jenis_transaksi_id', $id);
        })
        ->where('user_id', auth()->user()->id)
        ->where('adjust', 'yes')
        ->get();


        $param = [];
        foreach($anggaran as $item){
            $param [] = $item->kategori_transaksi_id;
        }


        Anggaran::where('user_id',auth()->user()->id)->whereIn('kategori_transaksi_id', $param)->where('adjust', 'no')->delete();

    }

    public static function adjustAnggaran($index, $id)
    {
        $kategoriTransaksi = Kategori_transaksi::where('jenis_transaksi_id', $id)->get();


        $kategoriAnggaranId = DatabaseHelper::getJumlahBudgeting()[$index]->id;

        // $jumlahKebutuhan = intval( DatabaseHelper::getJumlahBudgeting()[$index]->jumlah);
        // $countKategoriTransaksi = Kategori_transaksi::where('jenis_transaksi_id', $id)->count()-1;


        $anggaran = Anggaran::whereHas('kategori_transaksi', function ($query) use ($id) {
            $query->where('jenis_transaksi_id', $id);
        })
        ->where('user_id', auth()->user()->id)
        ->where('adjust', 'yes');

        $countAnggaran = $anggaran->count() ?? 0;
        $jumlahAnggaran = $anggaran->sum('jumlah') ?? 0;

        $jumlahKebutuhan = intval( DatabaseHelper::getJumlahBudgeting()[$index]->jumlah - $jumlahAnggaran);
        $countKategoriTransaksi = Kategori_transaksi::where('jenis_transaksi_id', $id)->count() - $countAnggaran;

        // return $countKategoriTransaksi;


        $jumlahAnggaran = floor( $jumlahKebutuhan/$countKategoriTransaksi);
        // $jumlahAnggaran = floor( $jumlahKebutuhan/$countKategoriTransaksi);

        $nilaiAnggaran = [];

        foreach ($kategoriTransaksi as $i => $item) {
            $nilaiAnggaran[] = [
                'upsert_id' => intval($i + 1) . intval($item->id) . intval(auth()->user()->id),
                'kategori_transaksi_id' => $item->id,
                'jumlah' => $jumlahAnggaran,
                'user_id' => auth()->user()->id,
                'kategori_anggaran_id' => $kategoriAnggaranId,
            ];
        }

        Anggaran::upsert(
            $nilaiAnggaran,
            ['upsert_id'], // Kunci untuk menentukan baris yang sudah ada
            ['jumlah']  // Kolom-kolom yang akan di-update atau di-insert
        );

        $anggaran = Anggaran::whereHas('kategori_transaksi', function ($query) use ($id) {
            $query->where('jenis_transaksi_id', $id);
        })
        ->where('user_id', auth()->user()->id)
        ->where('adjust', 'yes')
        ->get();


        $param = [];
        foreach($anggaran as $item){
            $param [] = $item->kategori_transaksi_id;
        }


        Anggaran::where('user_id',auth()->user()->id)->whereIn('kategori_transaksi_id', $param)->where('adjust', 'no')->delete();

    }
}
