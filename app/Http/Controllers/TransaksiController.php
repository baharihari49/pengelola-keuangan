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

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        return view('dashboard.transaksi.index', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'transaksi' => Transaksi::with(['kategori_transaksi', 'jenis_transaksi'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(20),
            'dataBulan' => DatabaseHelper::getMonthTransaki(),
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
        $validate = $request->validate([
            'tanggal' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'kategori_transaksi_id' => 'required',
            'jenis_transaksi_id' => 'required',
        ]);


        
        
        $validate['user_id'] = auth()->user()->id;
        
        // Ambil ID terakhir dari tabel Transaksi
        $lastTransaction = Transaksi::where('user_id', auth()->user()->id)->select('id')->latest('id')->first();

        if ($lastTransaction) {
            $lastTransactionId = $lastTransaction->id;
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

        if(empty($data_anggaran[0]['jumlah'])){
            $validate['anggaran'] = false;
            Transaksi::create($validate);
            Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
            return redirect('/transaksi')->with('sucsess', 'Data berhasil ditambahkan');
        }else if($total_jumlah <= $data_anggaran[0]['jumlah']){
            $validate['anggaran'] = true;
            Transaksi::create($validate);
            Kategori_transaksi::where('id', $validate['kategori_transaksi_id'])->update(['show' => false]);
            return redirect('/transaksi')->with('sucsess', 'Data berhas     il ditambahkan');
        }else{
            return redirect('/transaksi')->with('error', 'Data gagal ditambahakan');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
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

        // return $request;
        $validate = $request->validate([
            'deskripsi' => 'required',
        ]);

        $data_anggaran = Anggaran::where('user_id', auth()->user()->id)->where('kategori_transaksi_id', request('old_kategori_transaksi_id'))->get();

        $validate['user_id'] = auth()->user()->id;


        // return $validate;

        Transaksi::where('user_id', auth()->user()->id)
                    ->where('uuid', $request->uuid)
                    ->update($validate);

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
        $records = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                            ->where('transaksis.user_id', auth()->user()->id);

        if (request()->has('id') && request()->id !== 'all') {
            $records->where('transaksis.jenis_transaksi_id', request()->id); // Menggunakan alias 'transaksis' untuk jenis_transaksi_id
        }

        $records = $records->orderBy('created_at', 'desc');

        $records = $records->select('kategori_transaksis.nama', 'transaksis.*')
                 ->get();


        
        return $records;                    
    }


    public function api3() 
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id);

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
                ->select(DB::raw('DATE(created_at) as tanggal'))
                ->whereMonth('created_at', DatabaseHelper::getMonth())
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
}
