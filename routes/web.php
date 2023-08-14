<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Models\Anggaran;
use App\Models\Dashboard;
use App\Models\Kategori_transaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeUnit\FunctionUnit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/', DashboardController::class);

Route::resource('/transaksi', TransaksiController::class);

Route::put('/transaksi', [TransaksiController::class, 'update']);

Route::delete('/transaksi', [TransaksiController::class, 'destroy']);

Route::get('/get_transaksi_by_jenis_transaksi_id', [TransaksiController::class, 'api2']);

Route::get('/get_transaksi_by_search', [TransaksiController::class, 'api3']);

Route::get('/get_transaksi_by_jenis_transaksi_id_line_chart', [TransaksiController::class, 'api4']);

Route::get('/get_transaksi_by_days', [TransaksiController::class, 'api5']);

Route::resource('/kategori_transaksi', KategoriTransaksiController::class);

Route::put('/kategori_transaksi', [KategoriTransaksiController::class, 'update']);

Route::get('/get_kategori_transaksi_by_jenis_transaksi_id', [KategoriTransaksiController::class, 'api']);

Route::get('/get_kategori_transaksi_by_id', [KategoriTransaksiController::class, 'api2']);

Route::get('/get_kategori_transaksi_by_jenis_transaksi_id_not_show', [KategoriTransaksiController::class, 'api4']);

Route::get('/get_kategori_transaksi_by_search', [KategoriTransaksiController::class, 'api5']);

Route::get('/get_kategori_transaksi_by_jenis_transaksi_select', [KategoriTransaksiController::class, 'api6']);



Route::get('/get_transaksi', [TransaksiController::class, 'api']);

Route::get('/get_jenis_transaksi', [JenisTransaksiController::class, 'api']);

Route::delete('/kategori_transaksi', [KategoriTransaksiController::class, 'destroy']);

Route::resource('/anggaran', AnggaranController::class);

Route::delete('/anggaran', [AnggaranController::class, 'destroy']);

Route::put('/anggaran', [AnggaranController::class, 'update']);

Route::get('/get_anggaran_by_id', [AnggaranController::class, 'api']);

Route::get('/get_all_anggaran', function() {
    $kategori_anggaran = Anggaran::with('Kategori_transaksi')->get();
    $anggaran = Anggaran::all();
    $nama_anggaran = [];
    $nama_kategori = [];
    foreach($kategori_anggaran as $kt) {
        $nama = $kt->Kategori_transaksi->nama;
        $nama_kategori[] = $nama;
    }
    foreach($anggaran as $a){
        $nama = $a->jumlah;
        $nama_anggaran[] = $nama;
    }
    return [
        'anggaran' => $nama_anggaran,
        'kategori_anggaran' => $nama_kategori
    ];
});


Route::get('/get_anggaran_by_kategori_transaksi', [AnggaranController::class, 'api2']);

Route::get('/get_kategori_transaksi_all_show_by_jenis_kategori_transaksi', [KategoriTransaksiController::class, 'api3']);