<?php

namespace App\Http\Controllers;

use App\Helper\DatabaseHelper;
use App\Models\Anggaran;
use App\Models\Jenis_transaksi;
use App\Models\Kategori_anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTransaksi;
use App\Models\User;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $a = Transaksi::with(['kategori_transaksi', 'jenis_transaksi'])
        // ->where('user_id', Auth::id())
        // ->orderBy('created_at', 'desc')
        // ->paginate(20);
        // return response()->json($a);
        return view('dashboard.transaksi.index', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'transaksi' => Transaksi::with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
                ->where('user_id', Auth::id())
                ->where('void', false)
                ->orderBy('created_at', 'desc')
                ->paginate(15),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
            'user' => DatabaseHelper::getUser()[0],
        ]);
    }

    public function transaksiExcel()
    {
        return Excel::download(new ExportTransaksi, 'transaksi.xlsx');
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
        $validate = $request->validate([
            'tanggal' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'kategori_transaksi_id' => 'required',
            'suppliers_or_customers_id' => 'max:255',
            'jenis_transaksi_id' => 'required',
            'deskripsi' => 'max:255'
        ]);



        $validate['user_id'] = auth()->user()->id;

        // Ambil ID terakhir dari tabel Transaksi
        $lastTransaction = Transaksi::where('user_id', auth()->user()->id)->where('void', false)->count();

        if ($lastTransaction) {
            $lastTransactionId = $lastTransaction;
        } else {
            $lastTransactionId = 0;
        }

        // Tetapkan $no_transaksi berdasarkan jenis transaksi dan nomor ID terakhir
        if ($validate['jenis_transaksi_id'] == 1) {
            $validate['no_transaksi'] = 'ITR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        } elseif ($validate['jenis_transaksi_id'] == 2) {
            $validate['no_transaksi'] = 'OTR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        } else {
            $validate['no_transaksi'] = 'STR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        }

        // $no_transaksi sekarang berisi nomor transaksi yang sesuai


        // return $validate;


        $data_transaksi = Transaksi::where('kategori_transaksi_id', $validate['kategori_transaksi_id'])
                        ->where('user_id', auth()->user()->id)
                        ->whereMonth('created_at', DatabaseHelper::getMonth())
                        ->select('kategori_transaksi_id')
                        ->selectRaw('SUM(jumlah) as total_jumlah')
                        ->groupBy('kategori_transaksi_id')
                        ->get();

        if(count($data_transaksi) > 0){
            $total_jumlah = $data_transaksi[0]->total_jumlah += intval($validate['jumlah']);
        }else(
            $total_jumlah = 0
        );

        $data_anggaran = Anggaran::where('user_id', auth()->user()->id)
                                ->where('kategori_transaksi_id', $validate['kategori_transaksi_id'])
                                ->whereMonth('created_at', DatabaseHelper::getMonth())
                                ->get();

        if($validate['suppliers_or_customers_id'] === 'Select Supplier/Customer') {
            $validate['suppliers_or_customers_id'] = 0;
        }

        $user = User::where('id', auth()->user()->id)->first();

        if($user->payment_id != null && $user->payment != null){
           if($user->payment->status == 'pending') {
                if(Transaksi::where('user_id', auth()->user()->id)->count() > 5) {
                    return redirect('/transaksi');
                }else{
                    if(empty($data_anggaran[0]['jumlah'])){
                        $validate['anggaran'] = false;
                        Transaksi::create($validate);
                        Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                        return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                    }else if($total_jumlah <= $data_anggaran[0]['jumlah']){
                        $validate['anggaran'] = true;
                        Transaksi::create($validate);
                        Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                        return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                    }else{
                        return redirect('/transaksi')->with('error', 'Data gagal ditambahakan');
                    }
            }
           }else if($user->payment->status == 'successful'){
                if(empty($data_anggaran[0]['jumlah'])){
                    $validate['anggaran'] = false;
                    Transaksi::create($validate);
                    Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                    return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                }else if($total_jumlah <= $data_anggaran[0]['jumlah']){
                    $validate['anggaran'] = true;
                    Transaksi::create($validate);
                    Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                    return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                }else{
                    return redirect('/transaksi')->with('error', 'Data gagal ditambahakan');
                }
           }
        }else if($user->payment_id == null){
            if(Transaksi::where('user_id', auth()->user()->id)->count() > 5) {
                return redirect('/transaksi');
            }else{
                if(empty($data_anggaran[0]['jumlah'])){
                    $validate['anggaran'] = false;
                    Transaksi::create($validate);
                    Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                    return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                }else if($total_jumlah <= $data_anggaran[0]['jumlah']){
                    $validate['anggaran'] = true;
                    Transaksi::create($validate);
                    Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
                    return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
                }else{
                    return redirect('/transaksi')->with('error', 'Data gagal ditambahakan');
                }
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return view('dashboard.transaksi.layouts.detail_transaksi', [
            'data' => Transaksi::where('user_id', auth()->user()->id)->where('uuid', request()->uuid)->with('jenis_transaksi', 'kategori_transaksi')->get(),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {

        $void['void'] = request()->void = true;

        Transaksi::where('user_id', auth()->user()->id)
                    ->where('uuid', $request->uuid)
                    ->update($void);

        $validate = $request->validate([
            'tanggal' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'kategori_transaksi_id' => 'required',
            'suppliers_or_customers_id' => 'max:255',
            'jenis_transaksi_id' => 'required',
            'deskripsi' => 'max:255'
        ]);

        $data_anggaran = Anggaran::where('user_id', auth()->user()->id)->where('kategori_transaksi_id', request('old_kategori_transaksi_id'))->get();

        $validate['user_id'] = auth()->user()->id;

        $validate['anggaran'] = request()->anggaran;

        $lastTransaction = Transaksi::where('user_id', auth()->user()->id)->where('void', false)->count();

        if ($lastTransaction) {
            $lastTransactionId = $lastTransaction;
        } else {
            $lastTransactionId = 0;
        }

        // Tetapkan $no_transaksi berdasarkan jenis transaksi dan nomor ID terakhir
        if ($validate['jenis_transaksi_id'] == 1) {
            $validate['no_transaksi'] = 'ITR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        } elseif ($validate['jenis_transaksi_id'] == 2) {
            $validate['no_transaksi'] = 'OTR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        } else {
            $validate['no_transaksi'] = 'STR-' . DatabaseHelper::getYear() . DatabaseHelper::getMonth() . '-00000' . ($lastTransactionId + 1);
        }


        Transaksi::where('user_id', auth()->user()->id)
                    ->where('uuid', request()->uuid)
                    ->create($validate);


        return redirect('/transaksi');



        // if(empty($data_anggaran[0]['jumlah'])) {
        //     Transaksi::where('user_id', auth()->user()->id)
        //               ->where('uuid', $request->uuid)
        //               ->update($validate);
        //     return redirect('/transaksi')->with('succes_update', 'Transaksi anda berhasi diperbarui');
        // }else if($validate['jumlah'] > $data_anggaran[0]['jumlah']){
        //     return redirect('/transaksi')->with('error', 'Data gagal ditambahkan');
        // }else{
        //     Transaksi::where('user_id', auth()->user()->id)
        //               ->where('uuid', $request->uuid)
        //               ->update($validate);
        //     return redirect('/transaksi')->with('succes_update', 'Transaksi anda berhasi diperbarui');
        // }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $data = Transaksi::where('uuid', request()->uuid)->get()[0]['kategori_transaksi_id'];
        Kategori_transaksi::where('id', $data)->update(['show' => true]);
        Transaksi::destroy(request()->uuid);
    }

    public function api() {
        return Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                        ->where('transaksis.uuid', request()->uuid)
                        ->where('transaksis.user_id', auth()->user()->id)
                        ->select(
                            'kategori_transaksis.nama as nama_kategori_transaksi',
                            'transaksis.*'
                        )
                        ->get();
    }

    public function api2() {
        $records = Transaksi::with('jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers')
                            ->where('transaksis.user_id', auth()->user()->id)
                            ->where('void', false);

        if (request()->has('id') && request()->id !== 'all') {
            $records->where('transaksis.jenis_transaksi_id', request()->id); // Menggunakan alias 'transaksis' untuk jenis_transaksi_id
        }

        $records = $records->orderBy('created_at', 'desc')->get();


        // $recordsFinal [] = [
        //     'tanggal' => $records->tanggal,
        //     'no_transaksi' => $records->no_transaksi,
        //     'jenis_transaksi_id' => $records->jenis_transaksi_id,
        //     'kategori_transaksi' => $records->kategori_transaksi->nama,
        //     'supplier_or_customer' => $records->suppliers_or_customers->nama_bisnis ?? '--',
        //     'deskripsi' => $records->deskripsi,
        //     'jumlah' => $records->jumlah,
        // ];


        return $records;
    }


    public function api3()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)
                                ->where('void', false);

        if (request()->has('Semua')) {
            $transaksi->where(function ($query) {
                $query->where('deskripsi', 'like', '%' . request('Semua') . '%')
                    ->orWhere('tanggal', 'like', '%' . request('Semua') . '%')
                    ->orWhere('jumlah', 'like', '%' . request('Semua') . '%');
            });
        }

        if (request()->has('Kategori')) {
            $transaksi->whereHas('kategori_transaksi', function ($query) {
                $query->where('nama', 'like', '%' . request('Kategori') . '%');
            });
        }

        // Menambahkan orderBy untuk mengurutkan berdasarkan kolom 'tanggal' secara menurun
        $transaksi = $transaksi->orderBy('tanggal', 'desc')->get();


        if(count($transaksi) > 0) {
            foreach($transaksi as $tr) {
                $result [] = [
                    'jumlah' => $tr->jumlah,
                    'tanggal' => $tr->tanggal,
                    'kategori_transaksi' => $tr->Kategori_transaksi->nama ?? '--',
                    'uuid' => $tr->uuid,
                    'jenis_transaksi' => $tr->jenis_transaksi_id,
                    'deskripsi' => $tr->deskripsi,
                    'total_transaksi' => number_format($transaksi->sum('jumlah'), 0, ',', '.')
                ];
            }
        }else{
            $result = [];
        }

        return $result;
    }

    public function api4()
    {

        $dataTanggal = Transaksi::where('user_id', auth()->user()->id)
                ->where('void', false)
                ->select(DB::raw('DATE(created_at) as tanggal'))
                ->whereMonth('tanggal', DatabaseHelper::getMonth())
                ->distinct()
                ->orderBy('tanggal', 'desc') // Mengatur urutan menjadi ascending
                ->paginate((isset(request()->paginate) ? request()->paginate : 7));

        // return $dataTanggal;

        // Mengonversi data ke dalam bentuk array
        $dataTanggalArray = $dataTanggal->toArray();

        // Membalikkan urutan array menggunakan array_reverse
        $dataTanggalReversed = array_reverse($dataTanggalArray['data']);

        // return $dataTanggalReversed;

        // Mengembalikan data yang telah diurutkan dari bawah ke atas
        $dataTanggal['data'] = $dataTanggalReversed;

        // return $dataTanggal;

        $dataTanggal = $dataTanggal['data'];

        // return $dataTanggal;

        // Ambil data jumlah untuk setiap tanggal
        $records = Transaksi::where('user_id', auth()->user()->id)
                            ->where('jenis_transaksi_id', request()->id)
                            ->where('void', false)
                            ->select(
                                DB::raw('DATE(created_at) as tanggal'),
                                DB::raw('SUM(jumlah) as jumlah'),
                                'transaksis.jenis_transaksi_id'
                            )
                            ->groupBy(DB::raw('DATE(created_at)'), 'transaksis.jenis_transaksi_id')
                            ->get();

        // Buat array baru untuk hasil akhir
        $hasilAkhir = [];

        // Iterasi melalui data tanggal unik
        foreach ($dataTanggal as $tanggal) {
            $tanggalData = $tanggal['tanggal'];

            // Temukan data jumlah yang sesuai dengan tanggal
            $jumlahData = $records->where('tanggal', $tanggalData)->first();

            // Buat entri baru dengan tanggal dan jumlah yang sesuai
            $hasilAkhir[] = [
                'tanggal' => $tanggalData,
                'jumlah' => $jumlahData ? $jumlahData->jumlah : 0, // Jika tidak ada, set jumlah menjadi 0
            ];
        }

        // Hasil akhir akan berisi data yang Anda inginkan



        return $hasilAkhir;


    }

    public function api5()
    {
        $yesterday = Carbon::now()->subDay()->toDateString();
        $now = now()->format('Y-m-d');

        if(request()->days == 'Yesterday'){
            $transaksi = Transaksi::where('user_id', auth()->user()->id)->whereDate('created_at', $yesterday)->get();
            foreach($transaksi as $t) {
                $data [] = [
                    'jumlah' => $t->jumlah,
                    'kategori_transaksi' => $t->kategori_transaksi->nama,
                    'jenis_transaksi_id' => $t->jenis_transaksi_id,
                ];
            };
        }else{
            $transaksi = Transaksi::where('user_id', auth()->user()->id)->whereDate('created_at', $now)->get();
            foreach($transaksi as $t) {
                $data [] = [
                    'jumlah' => $t->jumlah,
                    'kategori_transaksi' => $t->kategori_transaksi->nama,
                    'jenis_transaksi_id' => $t->jenis_transaksi_id,
                ];
            };
        }

        return $data;

    }

    public function api6()
    {
        return Kategori_transaksi::where('jenis_transaksi_id', request()->id)->orWhere('user_id', auth()->user()->id)->Where('default', true)->get();
    }

    public function getTransaksiByDate()
    {
        $transaksi = Transaksi::with(['jenis_transaksi', 'kategori_transaksi', 'suppliers_or_customers'])
                            ->where('user_id', auth()->user()->id)
                            ->where('void', false)
                            ->orderBy('created_at', 'desc');

        if (request()->id == '0') {
            $transaksi = $transaksi->get();
        } else {
            $transaksi = $transaksi->whereMonth('tanggal', request()->id)->get();
        }

        return $transaksi;
        // $transaksiFinal = [];
        // foreach($transaksi as $item) {
        //     $transaksiFinal[] = [
        //         'no_transaksi' => $item->no_transaksi,
        //         'tanggal' => $item->tanggal,
        //         'kategori' => $item->kategori_transaksi->nama,
        //         'supplier' => $item->suppliers_or_customers->nama_bisnis ?? '--',
        //         'deskripsi' => $item->deskripsi ?? '--',
        //         'jumlah' => number_format($item->jumlah, 0 ,'.', ',')
        //     ];
        // }

        // return $transaksiFinal;
    }
}
