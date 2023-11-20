<?php

use App\Helper\DatabaseHelper;
use App\Http\Controllers\aksesLevelController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackCenterController;
use App\Http\Controllers\feedbackManage;
use App\Http\Controllers\informasiBisnisController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\KategoriAnggaranController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\printController;
use App\Http\Controllers\SuppliersorCustomersController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Anggaran;
use App\Models\Dashboard;
use App\Models\informasiBisnis;
use App\Models\Kategori_anggaran;
use App\Models\Kategori_transaksi;
use App\Models\SupplierorCustomers;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/email/verify', function () {
    return view('user.email_konfirmasi.index');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




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

            Route::get('/confirm_email', 'confirmEmail');

        });

    });
    Route::post('/logout', [LoginController::class, 'logout']);





Route::middleware(['auth', 'verified'])->group(function()
{

    Route::group(['middleware' => ['role:super admin']], function () {
        Route::controller(UserController::class)->group(function() {
            Route::get('/user', 'showUser');
            Route::post('/user', 'actionShowUser');
            Route::get('/give_role', 'giveRole');
            Route::get('remove_role', 'removeRole');
            Route::post('/create_user', 'createUserByAdmin');
            Route::delete('/delete_user', 'deleteUserByAdmin');
        });

        Route::controller(feedbackManage::class)->group(function()
        {
            Route::get('/feedback_manage', 'index');
            Route::get('/feedback_detail', 'detail');
            Route::put('/on_going', 'onGoing');
            Route::put('/done', 'done');
            Route::put('/cancel_done', 'cancel');
        });

        Route::controller(aksesLevelController::class)->group(function()
        {
            Route::get('/akses_level', 'index');
            Route::post('/store_akses_level', 'store');
            Route::put('/update_akses_level', 'update');
            Route::delete('/delete_akses_level', 'delete');
            Route::get('/edit_akses_level', 'editAksesLevel');
            Route::post('/edit_permission', 'editPermission');
        });
    });

    Route::controller(informasiBisnisController::class)->group(function()
    {
        Route::post('store_info_bisnis', 'store');
        Route::delete('/delete_logo', 'deleteLogo');
    });

   Route::controller(UserController::class)->group(function()
   {
    Route::get('/profile','show');

    Route::put('/user', 'update');

    Route::delete('/delete_image', 'deleteImage');

    Route::post('/store_image', 'storeImage');
   });
});

Route::middleware(['auth', 'verified' ,'check.user'])->group(function()
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

        Route::get('/detail_transaksi', 'show');

        Route::get('/get_transaksi_by_month_year', 'getTransaksiByDate');

        Route::get('/transaksi_xlsx', 'transaksiExcel');

    });

    Route::controller(printController::class)->group(function()
    {
        Route::get('/pdf_detail_transaksi', 'dwonlodTransaksi');

        Route::get('/pdf_transaksi_month', 'dwonlodTransaksiByMonth');

        Route::get('/pdf_laporan_pemasukan', 'dwonlodTransaksiPemasukan');

        Route::get('/pdf_laporan_pengeluaran', 'dwonlodTransaksiPengeluaran');

        Route::get('pdf_laba_rugi', 'dwonlodLabaRugi');
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

        Route::get('/pemasukan', 'showLaporanPemasukan');

        Route::get('/pengeluaran', 'showLaporanPengeluaran');

        Route::get('/get_pemasukan_by_kategori_transaksi_id', 'getTransaksiByKategori');

        Route::get('/get_pemasukan_by_month', 'getTransaksiByMonth');

        Route::get('/laba_rugi', 'showLaporanLabaRugi');

        Route::get('/pemasukan_xlsx', 'pemasukanExcel');

        Route::get('/pengeluaran_xlsx', 'pengeluaranExcel');

        Route::get('laba_rugi_xlsx', 'labaRugiExcel');

    });

    Route::controller(SuppliersorCustomersController::class)->group(function()
    {
        Route::get('/supplier_costumer', 'index');

        Route::get('/get_suplier_by_jenis_transaksi_id', 'showSupOrCus');

        Route::get('/hapus_seeder', 'hapusSeeder');

        Route::post('/supplier_or_customer', 'store');

        Route::get('/get_sup_or_cos_by_no_hp', 'showDetail');

        Route::delete('/supplier_costumer_delete', 'destroy');

        Route::put('/supplier_or_customer_update', 'update');

    });

    Route::controller(FeedbackCenterController::class)->group(function()
    {
        Route::get('/feedback', 'index');

        Route::post('/feedback', 'store');
    });

});



Route::get('/info_bisni', function() {
    return informasiBisnis::all();
});
