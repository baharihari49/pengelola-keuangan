<?php

use App\Helper\DatabaseHelper;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\KategoriAnggaranController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Anggaran;
use App\Models\Dashboard;
use App\Models\Kategori_anggaran;
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

Route::middleware(['guest'])->group(function()
{
    Route::controller(UserController::class)->group(function()
    {
        Route::get('/register','index');

        Route::post('/register', 'store');
    });

});

Route::middleware(['guest'])->group(function()
{
    Route::controller(LoginController::class)->group(function()
        {
            Route::get('/login', 'login')->name('login');

            Route::post('/login', 'authenticate');

        });
});
Route::post('/logout', [LoginController::class, 'logout']);




Route::middleware(['auth'])->group(function()
{
    Route::controller(DashboardController::class)->group(function()
    {
        Route::get('/', 'index');

        Route::get('/get_persentase_transaksi_anggaran', 'get_persentase');

        Route::get('/get_perbandingan_pemasukan_pengeluaran', 'get_perbandingan_pemasukan_pengeluaran');

        Route::get('/get_budgeting', 'getBudgeting');

    });


    Route::controller(TransaksiController::class)->group(function() 
    {

        Route::get('/transaksi','index');

        Route::post('transaksi', 'store');

        Route::put('/transaksi', 'update');
        
        Route::delete('/transaksi', 'destroy');

        Route::get('/get_transaksi_by_jenis_transaksi_id', 'api2');
        
        Route::get('/get_transaksi_by_search', 'api3');
        
        Route::get('/get_transaksi_by_jenis_transaksi_id_line_chart', 'api4');
        
        Route::get('/get_transaksi_by_days', 'api5');

        Route::get('/get_transaksi', 'api');

    });


    Route::controller(KategoriTransaksiController::class)->group(function() 
    {

        Route::get('/kategori_transaksi', 'index');

        Route::post('/kategori_transaksi', 'store');
        
        Route::put('/kategori_transaksi', 'update');
        
        Route::get('/get_kategori_transaksi_by_jenis_transaksi_id', 'api');
        
        Route::get('/get_kategori_transaksi_by_id', 'api2');
        
        Route::get('/get_kategori_transaksi_by_jenis_transaksi_id_not_show', 'api4');
        
        Route::get('/get_kategori_transaksi_by_search', 'api5');
        
        Route::get('/get_kategori_transaksi_by_jenis_transaksi_select', 'api6');

        Route::delete('/kategori_transaksi', 'destroy');

        Route::get('/get_kategori_transaksi_all_show_by_jenis_kategori_transaksi','api3');

        Route::get('/get_kategori_transaksi_all', 'getAllTransaksi');
    });


    Route::controller(AnggaranController::class)->group(function() 
    {

        Route::get('/anggaran', 'index');

        Route::post('/anggaran', 'store');
        
        Route::delete('/anggaran', 'destroy');
        
        Route::put('/anggaran', 'update');
        
        Route::get('/get_anggaran_by_id', 'api');
        
        Route::get('/get_all_anggaran', function() {
            $records = Anggaran::join('kategori_transaksis', 'anggarans.kategori_transaksi_id', '=', 'kategori_transaksis.id')
                                ->where('anggarans.user_id', auth()->user()->id)
                                ->select(
                                    'kategori_transaksis.nama',
                                    'anggarans.jumlah'
                                )
                                ->groupBy('anggarans.jumlah', 'kategori_transaksis.nama')
                                ->get();

            $jumlah_anggaran = [];
            $kategori_anggaran = [];
            foreach($records as $item) {
                array_push($jumlah_anggaran, $item->jumlah);
                array_push($kategori_anggaran, $item->nama);
            };

            return [
                'anggaran' => $jumlah_anggaran,
                'kategori_anggaran' => $kategori_anggaran,
            ];

        });

        
        Route::get('/budgeting', 'budgeting');
        
        Route::get('/get_anggaran_by_kategori_transaksi', 'api2');

    });


    Route::controller(KategoriAnggaranController::class)->group(function()
    {
        Route::post('/budgeting_post', 'store');

        Route::post('/budgeting_edit', 'update');

        Route::get('/get_kategori_anggaran', 'getKategoriAnggaran');

        Route::delete('/budgeting_delete', 'destroy');

    });




    Route::get('/get_jenis_transaksi', [JenisTransaksiController::class, 'api']);


    Route::controller(LaporanController::class)->group(function()
    {
        Route::get('/laporan', 'index');
    });
});

Route::get('/panduan', function() {
    return view('dashboard.panduan.index');
});

Route::get('/profile', [UserController::class, 'show']);

Route::put('/user', [UserController::class, 'update']);