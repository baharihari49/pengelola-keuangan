<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategori_anggaranRequest;
use App\Http\Requests\UpdateKategori_anggaranRequest;
use App\Models\Kategori_anggaran;

class KategoriAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreKategori_anggaranRequest $request)
    {

        $validate = request()->validate([
            'value' => 'required',
            'nama' => 'required',
        ]);

        $jumlahValue = Kategori_anggaran::where('user_id', auth()->user()->id)
                                        ->sum('value');
        $limit = $jumlahValue + $validate['value'];

        if($limit <= 100){            
            $validate['user_id'] = auth()->user()->id;
            Kategori_anggaran::create($validate);
            return redirect('/anggaran');
        }

        return 'transaksi gagal';



    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori_anggaran $kategori_anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori_anggaran $kategori_anggaran)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategori_anggaranRequest $request, Kategori_anggaran $kategori_anggaran)
    {
        $validate = request()->validate([
            'value' => 'required',
            'nama' => 'required',
        ]);

        $jumlahValue = Kategori_anggaran::where('user_id', auth()->user()->id)
                                        ->sum('value');
        $limit = $jumlahValue + $validate['value'];

        if($limit <= 100){            
            $validate['user_id'] = auth()->user()->id;
            Kategori_anggaran::where('user_id', auth()->user()->id)
            ->where('nama', $validate['nama'])
            ->update($validate);
            return redirect('/anggaran');
        }

        return 'transaksi gagal';

        
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori_anggaran $kategori_anggaran)
    {
        //
    }

    public static function getKategoriAnggaran()
    {
        return Kategori_anggaran::where('user_id', auth()->user()->id)->select('id')->get();
    }
}
