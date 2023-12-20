<?php

namespace App\Http\Controllers;

use App\Models\Jenis_transaksi;
use App\Models\suppliers_or_customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\DatabaseHelper;

class SuppliersorCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return suppliers_or_customers::where('user_id', auth()->user()->id)->get();
        return view('dashboard.supplier.index', [
            'data' => suppliers_or_customers::where('user_id', auth()->user()->id)->with('jenis_transaksi')->paginate(15),
            // 'tipe' => Jenis_transaksi::whereIn('id', [1,2,3,4])->get(),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    public function showSupOrCus()
    {

        return suppliers_or_customers::where('user_id', auth()->user()->id)
                                  ->where('jenis_transaksi_id', request()->id)
                                  ->get();
    }

    public function hapusSeeder()
    {
        DB::table('suppliers_or_customers')->truncate();
        return suppliers_or_customers::where('user_id', auth()->user()->id)
                                  ->where('jenis_transaksi_id', request()->id)
                                  ->get();
    }

    public function showDetail()
    {
        return suppliers_or_customers::where('user_id', auth()->user()->id)
                                ->where('id', request()->id)
                                ->get();
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
            'nama_bisnis' => 'required',
            'alamat' => 'required',
            'email' => 'email|required',
            'no_hp' => 'required',
            'jenis_transaksi_id' => 'required'
        ]);

        $validate['user_id'] = auth()->user()->id;

        suppliers_or_customers::create($validate);

        return redirect('/supplier_costumer');
    }

    /**
     * Display the specified resource.
     */
    public function show(suppliers_or_customers $suppliers_or_customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suppliers_or_customers $suppliers_or_customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, suppliers_or_customers $suppliers_or_customers)
    {
        // return request();
        $validate = $request->validate([
            'nama_bisnis' => 'required',
            'alamat' => 'required',
            'email' => 'email|required',
            'no_hp' => 'required',
            'jenis_transaksi_id' => 'required'
        ]);

        suppliers_or_customers::where('user_id', auth()->user()->id)
                                ->where('email', $validate['email'])
                                ->update($validate);

        return redirect('/supplier_costumer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suppliers_or_customers $suppliers_or_customers)
    {
        // return request()->email;
        suppliers_or_customers::destroy(request()->id);
    }

    public function getJenisTransaksiByTipeSupplier()
    {

        $jenisTransaksi = Jenis_transaksi::query(); // Inisialisasi builder

        if (request()->id == 1) {
            $jenisTransaksi->whereIn('id', [1, 2]);
        } else if (request()->id == 2) {
            $jenisTransaksi->whereIn('id', [3, 4]);
        }

        $hasilQuery = $jenisTransaksi->get(); // Lakukan query dan dapatkan hasilnya

        return $hasilQuery;

    }
}
