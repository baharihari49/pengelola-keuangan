<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggaranRequest;
use App\Http\Requests\UpdateAnggaranRequest;
use App\Models\Anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use function PHPUnit\Framework\returnSelf;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $records = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                            ->select(
                                'transaksis.kategori_transaksi_id',
                                DB::raw('SUM(transaksis.jumlah / anggarans.jumlah * 100) AS total_persentase')
                            )
                            ->groupBy('transaksis.kategori_transaksi_id')
                            ->get();    

        $data_peresentase = [];

        foreach ($records as $record) {
            $data_peresentase[] = [
                'kategori_transaksi_id' => $record->kategori_transaksi_id,
                'persentase' => $record->total_persentase,
            ];
        }

        $test = Anggaran::all();

        $data_anggaran = json_decode($test, true);

        $result = [];


        $result = array_reduce($data_anggaran, function ($carry, $item) use ($data_peresentase) {
            $kategori_transaksi_id = $item['kategori_transaksi_id'] ?? 0;
            $persentase = 0;

        
            foreach ($data_peresentase as $data_a) {
                if ($data_a['kategori_transaksi_id'] === $kategori_transaksi_id) {
                    $persentase = number_format((float) $data_a['persentase'], 0);
                    break;
                }
            }
        
            $carry[] = [
                'kategori_transaksi_id' => $kategori_transaksi_id,
                'persentase' => $persentase,
            ];
        
            return $carry;
        }, []);


        // return $result;

        return view('dashboard.anggaran.index', [
            'Anggaran' => Anggaran::all(),
            'persentase' => $result,
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
    public function store(StoreAnggaranRequest $request)
    {
        $validate = $request->validate([
            'jumlah' => 'required',
            'kategori_transaksi_id' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required'
        ]);

        $validate['user_id'] = 1;

        $validate['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', request()->tanggal_mulai)->format('Y-m-d');
        $validate['tanggal_berakhir'] = Carbon::createFromFormat('d/m/Y', request()->tanggal_berakhir)->format('Y-m-d');

        Anggaran::create($validate);

        return redirect('/anggaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggaran $anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggaran $anggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggaranRequest $request, Anggaran $anggaran)
    {
        $validate = $request->validate([
            'jumlah' => 'required',
            'kategori_transaksi_id' => 'required',
        ]);

        $validate['user_id'] = 1;

        Anggaran::where('id', request()->id)
                ->update($validate);

        return redirect('/anggaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggaran $anggaran)
    {
        Anggaran::destroy(request()->id);
    }

    public function api()
    {
        return Anggaran::where('id', request()->id)->get();
    }

    public function api2() {
        $data_anggaran = Anggaran::whereHas('kategori_transaksi', function($query) {
            $query->where('nama', 'like', '%' . request('nama') . '%');
        })->get();

        $records = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                            ->select(
                                'transaksis.kategori_transaksi_id',
                                'transaksis.jumlah AS jumlah_transaksi',
                                'anggarans.jumlah AS jumlah_anggaran',
                                DB::raw('(transaksis.jumlah / anggarans.jumlah * 100) AS persentase')
                            )->get();
        $data_peresentase = [];
        foreach($records as $rec) {
            $data_peresentase [] = [
                'kategori_transaksi_id' => $rec->kategori_transaksi_id,
                'persentase' => $rec->persentase
            ];
        }

        
        if(count($data_anggaran) > 0) {
            $result_data_anggaran = json_decode($data_anggaran, true);
            $data = array_reduce($result_data_anggaran, function($carry, $item) use ($data_peresentase){
                $kategori_transaksi_id = $item['kategori_transaksi_id'] ?? 0;
                $persentase = 0;
    
                foreach($data_peresentase as $data_p) {
                    if($data_p['kategori_transaksi_id'] == $kategori_transaksi_id) {
                        $persentase = number_format((float) $data_p['persentase'], 0);
                        break;
                    }
                }
    
                $data_kategori = Kategori_transaksi::where('id', $kategori_transaksi_id)->get();
    
                foreach($data_kategori as $dt) {
                    $carry [] = [
                        'jumlah' => $item['jumlah'],
                        'kategori_transaksi' => $dt->nama,
                        'persentase' => $persentase,
                    ];
                }
    
                return $carry;
            });
        }else{
            $data = [];
        }
        
        return $data;

    }
}
