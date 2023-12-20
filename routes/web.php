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
use App\Http\Controllers\paymentController;
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
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

Route::get('get-persentase-anggaran', function () {
    return DatabaseHelper::getPersentaseAnggaran(1);
});

Route::get('get-jumlah-budgeting', function () {
    return DatabaseHelper::getValueAnggaran(0, 3);
});

Route::get('get-now-month', function () {
    return DatabaseHelper::getNextMonth();
});

Route::get('update-anggaran', function () {
    return DatabaseHelper::updateAnggaran(0, 3);
});

Route::get('/get-budgeting', function () {
    return DatabaseHelper::getJumlahBudgeting();
});

Route::post('/create_payment/change_status', [paymentController::class, 'changeStatus']);

Route::get('/email/verify', function () {
    return view('user.email_konfirmasi.index');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/create_payment');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::middleware(['guest'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/register', 'index');

        Route::post('/register', 'store');
    });
});



// Reset password

Route::get('/forgot-password', function () {
    return view('user.forgotPassword.index');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('user.forgotPassword.formResetPassword.index', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');







Route::middleware(['guest'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');

        Route::post('/login', 'authenticate');

        Route::get('/confirm_email', 'confirmEmail');
    });
});
Route::post('/logout', [LoginController::class, 'logout']);





Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/create_payment', [paymentController::class, 'store']);
    Route::get('/create_payment', [paymentController::class, 'index']);
    Route::post('create-bill-va', [paymentController::class, 'createBillVA']);
    Route::get('/check-payment-status', [paymentController::class, 'checkPaymentStatus']);



    Route::group(['middleware' => ['role:super admin']], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'showUser');
            Route::post('/user', 'actionShowUser');
            Route::post('/give_role', 'giveRole');
            Route::get('remove_role', 'removeRole');
            Route::post('/create_user', 'createUserByAdmin');
            Route::delete('/delete_user', 'deleteUserByAdmin');
        });

        Route::controller(feedbackManage::class)->group(function () {
            Route::get('/feedback_manage', 'index');
            Route::get('/feedback_detail', 'detail');
            Route::put('/on_going', 'onGoing');
            Route::put('/done', 'done');
            Route::put('/cancel_done', 'cancel');
        });

        Route::controller(aksesLevelController::class)->group(function () {
            Route::get('/akses_level', 'index');
            Route::post('/store_akses_level', 'store');
            Route::put('/update_akses_level', 'update');
            Route::delete('/delete_akses_level', 'delete');
            Route::get('/edit_akses_level', 'editAksesLevel');
            Route::post('/edit_permission', 'editPermission');
        });
    });

    Route::controller(informasiBisnisController::class)->group(function () {
        Route::post('store_info_bisnis', 'store');
        Route::delete('/delete_logo', 'deleteLogo');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'show');

        Route::put('/user', 'update');

        Route::delete('/delete_image', 'deleteImage');

        Route::post('/store_image', 'storeImage');
    });
});

Route::middleware(['auth', 'verified', 'check.user', 'free_account'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');

        Route::get('/get_persentase_transaksi_anggaran', 'get_persentase');

        Route::get('/get_perbandingan_pemasukan_pengeluaran', 'get_perbandingan_pemasukan_pengeluaran');

        Route::get('/get_budgeting', 'getBudgeting');
        Route::get('/get_keuangan_bulanan', 'get_keuangan_bulanan');
    });


    Route::controller(TransaksiController::class)->group(function () {

        Route::get('/transaksi', 'index');

        Route::post('/transaksi', 'store');

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

    Route::controller(printController::class)->group(function () {
        Route::get('/pdf_detail_transaksi', 'dwonlodTransaksi');

        Route::get('/pdf_transaksi_month', 'dwonlodTransaksiByMonth');

        Route::get('/pdf_laporan_pemasukan', 'dwonlodTransaksiPemasukan');

        Route::get('/pdf_laporan_pengeluaran', 'dwonlodTransaksiPengeluaran');

        Route::get('pdf_laba_rugi', 'dwonlodLabaRugi');
    });

    Route::controller(KategoriTransaksiController::class)->group(function () {

        Route::get('/kategori_transaksi', 'index');

        Route::post('/kategori_transaksi', 'store');

        Route::put('/kategori_transaksi', 'update');

        Route::get('/get_kategori_transaksi_by_jenis_transaksi_id', 'api');

        Route::get('/get_kategori_transaksi_by_id', 'api2');

        Route::get('/get_kategori_transaksi_by_jenis_transaksi_id_not_show', 'api4');

        Route::get('/get_kategori_transaksi_by_search', 'api5');

        Route::get('/get_kategori_transaksi_by_jenis_transaksi_select', 'api6');

        Route::delete('/kategori_transaksi', 'destroy');

        Route::get('/get_kategori_transaksi_all_show_by_jenis_kategori_transaksi', 'api3');

        Route::get('/get_kategori_transaksi_all', 'getAllTransaksi');

        Route::get('/manage-kategori', 'manageKategori');

        Route::post('/manage-kategori-store', 'storeByAdmin');
    });


    Route::controller(AnggaranController::class)->group(function () {

        Route::get('/anggaran', 'index');

        Route::post('/anggaran', 'store');

        Route::delete('/anggaran', 'destroy');

        Route::put('/anggaran', 'update');

        Route::get('/get_anggaran_by_id', 'api');

        Route::get('/get_all_anggaran', function () {
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
            foreach ($records as $item) {
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


    Route::controller(KategoriAnggaranController::class)->group(function () {
        Route::post('/budgeting_post', 'store');

        Route::post('/budgeting_edit', 'update');

        Route::get('/get_kategori_anggaran', 'getKategoriAnggaran');

        Route::delete('/budgeting_delete', 'destroy');
    });




    Route::get('/get_jenis_transaksi', [JenisTransaksiController::class, 'api']);


    Route::controller(LaporanController::class)->group(function () {

        Route::get('/laporan', 'index');

        Route::get('/pemasukan', 'showLaporanPemasukan');

        Route::get('/pengeluaran', 'showLaporanPengeluaran');

        Route::get('/get_pemasukan_by_kategori_transaksi_id', 'getTransaksiByKategori');

        Route::get('/get_pemasukan_by_month', 'getTransaksiByMonth');

        Route::get('/laba_rugi', 'showLaporanLabaRugi');

        Route::get('/pemasukan_xlsx', 'pemasukanExcel');

        Route::get('/pengeluaran_xlsx', 'pengeluaranExcel');

        Route::get('laba_rugi_xlsx', 'labaRugiExcel');

        Route::get('jumlah-transaksi-by-month', 'getJumlahTransaksiByMonh');

        Route::get('jumlah-transaksi-by-kategori', 'getJumlahTransaksiByKategori');
    });

    Route::controller(SuppliersorCustomersController::class)->group(function () {
        Route::get('/supplier_costumer', 'index');

        Route::get('/get_suplier_by_jenis_transaksi_id', 'showSupOrCus');

        Route::get('/hapus_seeder', 'hapusSeeder');

        Route::post('/supplier_or_customer', 'store');

        Route::get('/get_sup_or_cos_by_no_hp', 'showDetail');

        Route::delete('/supplier_costumer_delete', 'destroy');

        Route::put('/supplier_or_customer_update', 'update');

        Route::get('/get-jenis-transaksi-by-tipe-supplier', 'getJenisTransaksiByTipeSupplier');

    });

    Route::controller(FeedbackCenterController::class)->group(function () {
        Route::get('/feedback', 'index');

        Route::post('/feedback', 'store');
    });

    Route::controller(paymentController::class)->group(function () {
        Route::post('test_payment', 'testPayment');
        Route::get('get_balance', 'getBalance');
        Route::post('disbursement', 'createDisbrusment');
        // Route::get('createKey', 'generatePrivateKey');
        Route::post('agents', 'makeAgents');
        Route::post('signature', 'generatePrivateKey');
        Route::get('get-disbursement', 'getDisbrusementById');
        Route::get('get-disbursement-by-idempotency', 'getDisbrusementByIdempotency');
        Route::get('get-all-disbrusement', 'getAllDisbrusment');
        Route::get('disbursement/city-list', 'cityList');
        Route::get('disbursement/country-list', 'countryList');
        Route::get('disbursement/city-country-list', 'cityAndCountryList');
        Route::post('disbursement/bank-account-inquiry', 'bankAccountInquiry');

        Route::get('/chose-payment-methode', 'chosePaymentMethode');

        Route::get('/payment-manage', 'paymentManage');
        Route::post('/payment-manage', 'paymentByExternalId');
    });
});



Route::get('/info_bisni', function () {
    return Transaksi::where('user_id', auth()->user()->id)
        ->whereIn('jenis_transaksi_id', [1, 2])
        ->where('void', false)
        ->whereMonth('tanggal', DatabaseHelper::getMonth())
        ->get();
});

Route::get('/get_pendapatan', function () {
    return response()->json([
        'pemasukan' => DatabaseHelper::getPendapatan(),
        'data' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->whereIn('transaksis.jenis_transaksi_id', [1, 2])
            ->whereIn('kategori_transaksis.jenis_transaksi_id', [1, 2])
            ->where('void', false)
            ->with(['kategori_transaksi', 'jenis_transaksi', 'suppliers_or_customers'])
            ->paginate(15),
        'kategori' => Transaksi::join('kategori_transaksis', 'transaksis.kategori_transaksi_id', '=', 'kategori_transaksis.id')
            ->where('transaksis.user_id', auth()->user()->id)
            ->where('void', false)
            ->whereIn('transaksis.jenis_transaksi_id', [1, 2])
            ->distinct()
            ->select('kategori_transaksis.nama', 'kategori_transaksis.id')
            ->groupBy('kategori_transaksis.nama', 'kategori_transaksis.id')
            ->get(),
        'dataBulan' => DatabaseHelper::getMonthTransaki(),
        'user' => DatabaseHelper::getUser()[0]
    ]);
});
