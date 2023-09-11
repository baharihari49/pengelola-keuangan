<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Jenis_transaksi;
use App\Models\Kategori_anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.transaksi.index', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'transaksi' => Transaksi::paginate(20),
            'total_transaksi' => number_format(Transaksi::sum('Jumlah'), 0, ',', '.'),
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
            'deskripsi' => 'required'
        ]);

        $validate['user_id'] = auth()->user()->id;

        $data_transaksi = Transaksi::where('kategori_transaksi_id', $validate['kategori_transaksi_id'])
                        ->select('kategori_transaksi_id')
                        ->selectRaw('SUM(jumlah) as total_jumlah')
                        ->groupBy('kategori_transaksi_id')
                        ->get();
                        
        if(count($data_transaksi) > 0){
            $total_jumlah = $data_transaksi[0]->total_jumlah += intval($validate['jumlah']);
        }else(
            $total_jumlah = 0
        );

        $data_anggaran = Anggaran::where('kategori_transaksi_id', $validate['kategori_transaksi_id'])->get();

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

        $validate = $request->validate([
            'tanggal' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'deskripsi' => 'required',
        ]);

        $data_anggaran = Anggaran::where('kategori_transaksi_id', request('old_kategori_transaksi_id'))->get();

        $validate['user_id'] = 1;

        if(empty($data_anggaran[0]['jumlah'])) {
            Transaksi::where('uuid', $request->uuid)
            ->update($validate);
            return redirect('/transaksi')->with('succes_update', 'Transaksi anda berhasi diperbarui');
        }else if($validate['jumlah'] > $data_anggaran[0]['jumlah']){
            return redirect('/transaksi')->with('error', 'Data gagal ditambahkan');
        }else{
            Transaksi::where('uuid', $request->uuid)
                    ->update($validate);
    
            return redirect('/transaksi')->with('succes_update', 'Transaksi anda berhasi diperbarui');
        }


        
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
        return Transaksi::where('uuid', request()->uuid)->get();
    }

    public function api2() {
        $records = Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                            ->where('transaksis.user_id', auth()->user()->id);

        if (request()->has('id') && request()->id !== 'all') {
            $records->where('transaksis.jenis_transaksi_id', request()->id); // Menggunakan alias 'transaksis' untuk jenis_transaksi_id
        }

        $records = $records->select('kategori_transaksis.nama', 'transaksis.*')
                 ->get();


        
        return $records;                    
    }


    public function api3() 
    {
        if(request()->has('Semua')){
            $transaksi = Transaksi::where('deskripsi', 'like', '%' . request('Semua') . '%')
                                    ->orWhere('tanggal', 'like', '%' . request('Semua') . '%')
                                    ->orWhere('jumlah', 'like', '%' . request('Semua') . '%')->get();
        }
        
        if(request()->has('Kategori')) {
            $transaksi = Transaksi::whereHas('kategori_transaksi', function($query){
                $query->where('nama', 'like', '%' . request('Kategori') . '%');
            })->get();
        }

        if(count($transaksi) > 0) {
            foreach($transaksi as $tr) {
                $result [] = [
                    'jumlah' => $tr->jumlah,
                    'tanggal' => $tr->tanggal,
                    'kategori_transaksi' => $tr->Kategori_transaksi->nama,
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
        $records = Transaksi::where('user_id', auth()->user()->id)
                            ->where('jenis_transaksi_id', request()->id)
                            ->select(
                                DB::raw('DATE(created_at) as tanggal'), 
                                DB::raw('SUM(jumlah) as jumlah'),
                                'transaksis.jenis_transaksi_id'
                                )
                            ->groupBy(DB::raw('DATE(created_at)'), 'transaksis.jenis_transaksi_id')
                            ->get();

        return $records;                    

        
    }

    public function api5()
    {
        $yesterday = Carbon::now()->subDay()->toDateString();
        $now = now()->format('Y-m-d');

        if(request()->days == 'Yesterday'){
            $transaksi = Transaksi::whereDate('created_at', $yesterday)->get();
            foreach($transaksi as $t) {
                $data [] = [
                    'jumlah' => $t->jumlah,
                    'kategori_transaksi' => $t->kategori_transaksi->nama,
                    'jenis_transaksi_id' => $t->jenis_transaksi_id,
                ];
            };
        }else{
            $transaksi = Transaksi::whereDate('created_at', $now)->get();
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
