<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggaranRequest;
use App\Http\Requests\UpdateAnggaranRequest;
use App\Models\Anggaran;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Kategori_anggaran;
use App\Helper\DatabaseHelper;


use function PHPUnit\Framework\returnSelf;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.anggaran.index', [
            'Anggaran' => Anggaran::where('user_id', auth()->user()->id)->get(),
            'dataBudgeting' => DatabaseHelper::getJumlahBudgeting(),
            'persentaseBudgeting' => DatabaseHelper::getPersentaseBudgeting(),
            'getBudgeting' => Kategori_anggaran::where('user_id', auth()->user()->id)->get(),
            'persentaseAnggarans' => DatabaseHelper::getPersentaseAnggaran(),
            'kategoriAnggarans' => Kategori_anggaran::where('user_id', auth()->user()->id)->get(),
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
        ]);

        if(!isset($validate['kategori_anggaran_id'])){
            $validate['kategori_anggaran_id'] = 0;
        }

        $validate['user_id'] = auth()->user()->id;

        // $validate['tanggal_mulai'] = Carbon::createFromFormat('d/m/Y', request()->tanggal_mulai)->format('Y-m-d');
        // $validate['tanggal_berakhir'] = Carbon::createFromFormat('d/m/Y', request()->tanggal_berakhir)->format('Y-m-d');

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

        $validate['user_id'] = auth()->user()->id;

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

        $records = Transaksi::join('anggarans', 'transaksis.kategori_transaksi_id', '=', 'anggarans.kategori_transaksi_id')
                            ->whereHas('kategori_transaksi', function($query){
                                $query->where('nama', 'like', '%' . request('nama') . '%');
                            })
                            ->select(
                                'anggarans.kategori_transaksi_id',
                                DB::raw('SUM(transaksis.jumlah) / anggarans.jumlah * 100 AS persentase')
                            )
                            ->groupBy('transaksis.kategori_transaksi_id', 'anggarans.kategori_transaksi_id', 'anggarans.jumlah')
                            ->get();

        return $records;              

    }

    public function budgeting()
    {
        return Transaksi::where('jenis_transaksi_id', 1)->sum("jumlah");
    }



    // public function budgeting_kebutuhan_data()
    // {
    //     $results = DB::table('transaksis')
    //                 ->select('kategori_transaksi_id', DB::raw('SUM(jumlah) as total_jumlah'))
    //                 ->groupBy('kategori_transaksi_id')
    //                 ->get();

    //     $anggaran = Anggaran::all();

       
    //     $result_budgeting = [];

    //     foreach($results as $r) {
    //         foreach($anggaran as $ang)
    //         if($r->kategori_transaksi_id == $ang->kategori_transaksi_id) {
    //             $result_budgeting [] = [
    //                 'kategori_transaksi' => Kategori_transaksi::where('id', $r->kategori_transaksi_id)->select('nama')->get()[0]->nama,
    //                 'kategori_anggaran' => $ang->kategori_anggaran_id,
    //                 'jumlah' => $r->total_jumlah,
    //             ];
    //         }
    //     }

    //     return $result_budgeting;
    // }
}
