<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('login');
});

Route::get('/keluar', function () {
    Auth::logout();
    return redirect('login');
})->name('Keluar');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:Admin'], 'prefix' => 'admin'], function () {
        Route::post('req/select-option/', [App\Helpers\Form::class, 'select_option'])->name('Admin Select Option');

        Route::prefix('beranda')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Beranda::class, 'index'])->name('Admin Beranda');
        });

        Route::prefix('profil')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Profil::class, 'index'])->name('Admin Profil');
            Route::get('/sunting', [App\Http\Controllers\Admin\Profil::class, 'edit'])->name('Admin Profil Edit');
            Route::post('/sunting/action', [App\Http\Controllers\Admin\Profil::class, 'update'])->name('Admin Profil Update');
        });

        Route::prefix('peralatan')->group(function () {
            Route::prefix('excavator')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'index'])->name('Admin Peralatan Excavator');
                Route::get('/tambah', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'create'])->name('Admin Peralatan Excavator Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'store'])->name('Admin Peralatan Excavator Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'show'])->name('Admin Peralatan Excavator Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'edit'])->name('Admin Peralatan Excavator Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'update'])->name('Admin Peralatan Excavator Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'destroy'])->name('Admin Peralatan Excavator Destroy');
            });

            Route::prefix('truk')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'index'])->name('Admin Peralatan Truk');
                Route::get('/tambah', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'create'])->name('Admin Peralatan Truk Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'store'])->name('Admin Peralatan Truk Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'show'])->name('Admin Peralatan Truk Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'edit'])->name('Admin Peralatan Truk Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'update'])->name('Admin Peralatan Truk Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'destroy'])->name('Admin Peralatan Truk Destroy');
            });

            Route::prefix('operasional')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'index'])->name('Admin Peralatan Operasional');
                Route::post('/req', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'req'])->name('Admin Peralatan Operasional Req');
                Route::get('/tambah', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'create'])->name('Admin Peralatan Operasional Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'store'])->name('Admin Peralatan Operasional Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'show'])->name('Admin Peralatan Operasional Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'edit'])->name('Admin Peralatan Operasional Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'update'])->name('Admin Peralatan Operasional Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'destroy'])->name('Admin Peralatan Operasional Destroy');
            });
        });

        Route::prefix('kepegawaian')->group(function () {
            Route::prefix('pegawai')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'index'])->name('Admin Kepegawaian Pegawai');
                Route::get('/tambah', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'create'])->name('Admin Kepegawaian Pegawai Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'store'])->name('Admin Kepegawaian Pegawai Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'show'])->name('Admin Kepegawaian Pegawai Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'edit'])->name('Admin Kepegawaian Pegawai Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'update'])->name('Admin Kepegawaian Pegawai Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'destroy'])->name('Admin Kepegawaian Pegawai Destroy');
            });

            Route::prefix('pinjaman')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'index'])->name('Admin Kepegawaian Pinjaman');
                Route::post('/req', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'req'])->name('Admin Kepegawaian Pinjaman Req');
                Route::get('/tambah', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'create'])->name('Admin Kepegawaian Pinjaman Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'store'])->name('Admin Kepegawaian Pinjaman Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'show'])->name('Admin Kepegawaian Pinjaman Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'edit'])->name('Admin Kepegawaian Pinjaman Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'update'])->name('Admin Kepegawaian Pinjaman Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'destroy'])->name('Admin Kepegawaian Pinjaman Destroy');
            });

            Route::prefix('gaji')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'index'])->name('Admin Kepegawaian Gaji');
                Route::post('/req', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'req'])->name('Admin Kepegawaian Gaji Req');
                Route::get('/tambah', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'create'])->name('Admin Kepegawaian Gaji Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'store'])->name('Admin Kepegawaian Gaji Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'show'])->name('Admin Kepegawaian Gaji Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'edit'])->name('Admin Kepegawaian Gaji Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'update'])->name('Admin Kepegawaian Gaji Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'destroy'])->name('Admin Kepegawaian Gaji Destroy');
            });
        });

        Route::prefix('gudang')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Gudang::class, 'index'])->name('Admin Gudang');
            Route::get('/tambah', [App\Http\Controllers\Admin\Gudang::class, 'create'])->name('Admin Gudang Create');
            Route::post('/tambah/action', [App\Http\Controllers\Admin\Gudang::class, 'store'])->name('Admin Gudang Store');
            Route::get('/{id}', [App\Http\Controllers\Admin\Gudang::class, 'show'])->name('Admin Gudang Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Gudang::class, 'edit'])->name('Admin Gudang Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Gudang::class, 'update'])->name('Admin Gudang Update');
            Route::post('/hapus', [App\Http\Controllers\Admin\Gudang::class, 'destroy'])->name('Admin Gudang Destroy');
        });

        Route::prefix('muatan')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Muatan::class, 'index'])->name('Admin Muatan');
            Route::get('/tambah', [App\Http\Controllers\Admin\Muatan::class, 'create'])->name('Admin Muatan Create');
            Route::post('/tambah/action', [App\Http\Controllers\Admin\Muatan::class, 'store'])->name('Admin Muatan Store');
            Route::get('/{id}', [App\Http\Controllers\Admin\Muatan::class, 'show'])->name('Admin Muatan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Muatan::class, 'edit'])->name('Admin Muatan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Muatan::class, 'update'])->name('Admin Muatan Update');
            Route::post('/hapus', [App\Http\Controllers\Admin\Muatan::class, 'destroy'])->name('Admin Muatan Destroy');
        });

        Route::prefix('penjualan')->group(function () {
            Route::prefix('trip')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'index'])->name('Admin Penjualan Trip');
                Route::get('/tambah', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'create'])->name('Admin Penjualan Trip Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'store'])->name('Admin Penjualan Trip Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'show'])->name('Admin Penjualan Trip Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'edit'])->name('Admin Penjualan Trip Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'update'])->name('Admin Penjualan Trip Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'destroy'])->name('Admin Penjualan Trip Destroy');
            });

            Route::prefix('customer')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'index'])->name('Admin Penjualan Customer');
                Route::get('/tambah', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'create'])->name('Admin Penjualan Customer Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'store'])->name('Admin Penjualan Customer Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'show'])->name('Admin Penjualan Customer Show');
                Route::get('/{id}/invoice', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'invoice'])->name('Admin Penjualan Customer Invoice');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'edit'])->name('Admin Penjualan Customer Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'update'])->name('Admin Penjualan Customer Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'destroy'])->name('Admin Penjualan Customer Destroy');
            });
        });

        Route::prefix('tabel')->group(function () {
            Route::get('peralatan/excavator', [App\Http\Controllers\Admin\Peralatan\Excavator::class, 'dt'])->name('Admin Tabel Peralatan Excavator');
            Route::get('peralatan/truk', [App\Http\Controllers\Admin\Peralatan\Truk::class, 'dt'])->name('Admin Tabel Peralatan Truk');
            Route::get('peralatan/operasional', [App\Http\Controllers\Admin\Peralatan\Operasional::class, 'dt'])->name('Admin Tabel Peralatan Operasional');
            Route::get('kepegawaian/pegawai', [App\Http\Controllers\Admin\Kepegawaian\Pegawai::class, 'dt'])->name('Admin Tabel Kepegawaian Pegawai');
            Route::get('kepegawaian/pinjaman', [App\Http\Controllers\Admin\Kepegawaian\Pinjaman::class, 'dt'])->name('Admin Tabel Kepegawaian Pinjaman');
            Route::get('kepegawaian/gaji', [App\Http\Controllers\Admin\Kepegawaian\Gaji::class, 'dt'])->name('Admin Tabel Kepegawaian Gaji');
            Route::get('penjualan/trip', [App\Http\Controllers\Admin\Penjualan\Trip::class, 'dt'])->name('Admin Tabel Penjualan Trip');
            Route::get('penjualan/customer', [App\Http\Controllers\Admin\Penjualan\Customer::class, 'dt'])->name('Admin Tabel Penjualan Customer');
            Route::get('gudang', [App\Http\Controllers\Admin\Gudang::class, 'dt'])->name('Admin Tabel Gudang');
            Route::get('muatan', [App\Http\Controllers\Admin\Muatan::class, 'dt'])->name('Admin Tabel Muatan');
        });
    });

    Route::group(['middleware' => ['role:Operator Excavator'], 'prefix' => 'operator-excavator'], function () {
        Route::post('req/select-option/', [App\Helpers\Form::class, 'select_option'])->name('Operator Excavator Select Option');

        Route::prefix('beranda')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Beranda::class, 'index'])->name('Operator Excavator Beranda');
        });

        Route::prefix('profil')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Profil::class, 'index'])->name('Operator Excavator Profil');
            Route::get('/sunting', [App\Http\Controllers\OperatorExcavator\Profil::class, 'edit'])->name('Operator Excavator Profil Edit');
            Route::post('/sunting/action', [App\Http\Controllers\OperatorExcavator\Profil::class, 'update'])->name('Operator Excavator Profil Update');
        });

        Route::prefix('operasional')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'index'])->name('Operator Excavator Operasional');
            Route::post('/req', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'req'])->name('Operator Excavator Operasional Req');
            Route::get('/tambah', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'create'])->name('Operator Excavator Operasional Create');
            Route::post('/tambah/action', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'store'])->name('Operator Excavator Operasional Store');
            Route::get('/{id}', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'show'])->name('Operator Excavator Operasional Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'edit'])->name('Operator Excavator Operasional Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'update'])->name('Operator Excavator Operasional Update');
            Route::post('/hapus', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'destroy'])->name('Operator Excavator Operasional Destroy');
        });

        Route::prefix('pinjaman')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'index'])->name('Operator Excavator Pinjaman');
            Route::post('/req', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'req'])->name('Operator Excavator Pinjaman Req');
            Route::get('/tambah', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'create'])->name('Operator Excavator Pinjaman Create');
            Route::post('/tambah/action', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'store'])->name('Operator Excavator Pinjaman Store');
            Route::get('/{id}', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'show'])->name('Operator Excavator Pinjaman Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'edit'])->name('Operator Excavator Pinjaman Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'update'])->name('Operator Excavator Pinjaman Update');
            Route::post('/hapus', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'destroy'])->name('Operator Excavator Pinjaman Destroy');
        });

        Route::prefix('gaji')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'index'])->name('Operator Excavator Gaji');
            Route::post('/req', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'req'])->name('Operator Excavator Gaji Req');
            Route::get('/tambah', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'create'])->name('Operator Excavator Gaji Create');
            Route::post('/tambah/action', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'store'])->name('Operator Excavator Gaji Store');
            Route::get('/{id}', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'show'])->name('Operator Excavator Gaji Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'edit'])->name('Operator Excavator Gaji Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'update'])->name('Operator Excavator Gaji Update');
            Route::post('/hapus', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'destroy'])->name('Operator Excavator Gaji Destroy');
        });

        Route::prefix('muatan')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'index'])->name('Operator Excavator Muatan');
            Route::get('/tambah', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'create'])->name('Operator Excavator Muatan Create');
            Route::post('/tambah/action', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'store'])->name('Operator Excavator Muatan Store');
            Route::get('/{id}', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'show'])->name('Operator Excavator Muatan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'edit'])->name('Operator Excavator Muatan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'update'])->name('Operator Excavator Muatan Update');
            Route::post('/hapus', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'destroy'])->name('Operator Excavator Muatan Destroy');
        });

        Route::prefix('penjualan')->group(function () {
            Route::get('', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'index'])->name('Operator Excavator Penjualan');
            Route::get('/tambah', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'create'])->name('Operator Excavator Penjualan Create');
            Route::post('/tambah/action', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'store'])->name('Operator Excavator Penjualan Store');
            Route::get('/{id}', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'show'])->name('Operator Excavator Penjualan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'edit'])->name('Operator Excavator Penjualan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'update'])->name('Operator Excavator Penjualan Update');
            Route::post('/hapus', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'destroy'])->name('Operator Excavator Penjualan Destroy');
        });

        Route::prefix('tabel')->group(function () {
            Route::get('operasional', [App\Http\Controllers\OperatorExcavator\Operasional::class, 'dt'])->name('Operator Excavator Tabel Operasional');
            Route::get('pinjaman', [App\Http\Controllers\OperatorExcavator\Pinjaman::class, 'dt'])->name('Operator Excavator Tabel Pinjaman');
            Route::get('gaji', [App\Http\Controllers\OperatorExcavator\Gaji::class, 'dt'])->name('Operator Excavator Tabel Gaji');
            Route::get('penjualan', [App\Http\Controllers\OperatorExcavator\Penjualan::class, 'dt'])->name('Operator Excavator Tabel Penjualan');
            Route::get('muatan', [App\Http\Controllers\OperatorExcavator\Muatan::class, 'dt'])->name('Operator Excavator Tabel Muatan');
        });
    });

    Route::group(['middleware' => ['role:Supir'], 'prefix' => 'supir'], function () {
        Route::post('req/select-option/', [App\Helpers\Form::class, 'select_option'])->name('Supir Select Option');

        Route::prefix('beranda')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Beranda::class, 'index'])->name('Supir Beranda');
        });

        Route::prefix('profil')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Profil::class, 'index'])->name('Supir Profil');
            Route::get('/sunting', [App\Http\Controllers\Supir\Profil::class, 'edit'])->name('Supir Profil Edit');
            Route::post('/sunting/action', [App\Http\Controllers\Supir\Profil::class, 'update'])->name('Supir Profil Update');
        });

        Route::prefix('operasional')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Operasional::class, 'index'])->name('Supir Operasional');
            Route::post('/req', [App\Http\Controllers\Supir\Operasional::class, 'req'])->name('Supir Operasional Req');
            Route::get('/tambah', [App\Http\Controllers\Supir\Operasional::class, 'create'])->name('Supir Operasional Create');
            Route::post('/tambah/action', [App\Http\Controllers\Supir\Operasional::class, 'store'])->name('Supir Operasional Store');
            Route::get('/{id}', [App\Http\Controllers\Supir\Operasional::class, 'show'])->name('Supir Operasional Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Supir\Operasional::class, 'edit'])->name('Supir Operasional Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Supir\Operasional::class, 'update'])->name('Supir Operasional Update');
            Route::post('/hapus', [App\Http\Controllers\Supir\Operasional::class, 'destroy'])->name('Supir Operasional Destroy');
        });

        Route::prefix('pinjaman')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Pinjaman::class, 'index'])->name('Supir Pinjaman');
            Route::post('/req', [App\Http\Controllers\Supir\Pinjaman::class, 'req'])->name('Supir Pinjaman Req');
            Route::get('/tambah', [App\Http\Controllers\Supir\Pinjaman::class, 'create'])->name('Supir Pinjaman Create');
            Route::post('/tambah/action', [App\Http\Controllers\Supir\Pinjaman::class, 'store'])->name('Supir Pinjaman Store');
            Route::get('/{id}', [App\Http\Controllers\Supir\Pinjaman::class, 'show'])->name('Supir Pinjaman Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Supir\Pinjaman::class, 'edit'])->name('Supir Pinjaman Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Supir\Pinjaman::class, 'update'])->name('Supir Pinjaman Update');
            Route::post('/hapus', [App\Http\Controllers\Supir\Pinjaman::class, 'destroy'])->name('Supir Pinjaman Destroy');
        });

        Route::prefix('gaji')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Gaji::class, 'index'])->name('Supir Gaji');
            Route::post('/req', [App\Http\Controllers\Supir\Gaji::class, 'req'])->name('Supir Gaji Req');
            Route::get('/tambah', [App\Http\Controllers\Supir\Gaji::class, 'create'])->name('Supir Gaji Create');
            Route::post('/tambah/action', [App\Http\Controllers\Supir\Gaji::class, 'store'])->name('Supir Gaji Store');
            Route::get('/{id}', [App\Http\Controllers\Supir\Gaji::class, 'show'])->name('Supir Gaji Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Supir\Gaji::class, 'edit'])->name('Supir Gaji Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Supir\Gaji::class, 'update'])->name('Supir Gaji Update');
            Route::post('/hapus', [App\Http\Controllers\Supir\Gaji::class, 'destroy'])->name('Supir Gaji Destroy');
        });

        Route::prefix('muatan')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Muatan::class, 'index'])->name('Supir Muatan');
            Route::get('/tambah', [App\Http\Controllers\Supir\Muatan::class, 'create'])->name('Supir Muatan Create');
            Route::post('/tambah/action', [App\Http\Controllers\Supir\Muatan::class, 'store'])->name('Supir Muatan Store');
            Route::get('/{id}', [App\Http\Controllers\Supir\Muatan::class, 'show'])->name('Supir Muatan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Supir\Muatan::class, 'edit'])->name('Supir Muatan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Supir\Muatan::class, 'update'])->name('Supir Muatan Update');
            Route::post('/hapus', [App\Http\Controllers\Supir\Muatan::class, 'destroy'])->name('Supir Muatan Destroy');
        });

        Route::prefix('penjualan')->group(function () {
            Route::get('', [App\Http\Controllers\Supir\Penjualan::class, 'index'])->name('Supir Penjualan');
            Route::get('/tambah', [App\Http\Controllers\Supir\Penjualan::class, 'create'])->name('Supir Penjualan Create');
            Route::post('/tambah/action', [App\Http\Controllers\Supir\Penjualan::class, 'store'])->name('Supir Penjualan Store');
            Route::get('/{id}', [App\Http\Controllers\Supir\Penjualan::class, 'show'])->name('Supir Penjualan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Supir\Penjualan::class, 'edit'])->name('Supir Penjualan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Supir\Penjualan::class, 'update'])->name('Supir Penjualan Update');
            Route::post('/hapus', [App\Http\Controllers\Supir\Penjualan::class, 'destroy'])->name('Supir Penjualan Destroy');
        });

        Route::prefix('tabel')->group(function () {
            Route::get('operasional', [App\Http\Controllers\Supir\Operasional::class, 'dt'])->name('Supir Tabel Operasional');
            Route::get('pinjaman', [App\Http\Controllers\Supir\Pinjaman::class, 'dt'])->name('Supir Tabel Pinjaman');
            Route::get('gaji', [App\Http\Controllers\Supir\Gaji::class, 'dt'])->name('Supir Tabel Gaji');
            Route::get('penjualan', [App\Http\Controllers\Supir\Penjualan::class, 'dt'])->name('Supir Tabel Penjualan');
            Route::get('muatan', [App\Http\Controllers\Supir\Muatan::class, 'dt'])->name('Supir Tabel Muatan');
        });
    });

    Route::group(['middleware' => ['role:Owner'], 'prefix' => 'owner'], function () {
        Route::post('req/select-option/', [App\Helpers\Form::class, 'select_option'])->name('Owner Select Option');

        Route::prefix('beranda')->group(function () {
            Route::get('', [App\Http\Controllers\Owner\Beranda::class, 'index'])->name('Owner Beranda');
        });

        Route::prefix('profil')->group(function () {
            Route::get('', [App\Http\Controllers\Owner\Profil::class, 'index'])->name('Owner Profil');
            Route::get('/sunting', [App\Http\Controllers\Owner\Profil::class, 'edit'])->name('Owner Profil Edit');
            Route::post('/sunting/action', [App\Http\Controllers\Owner\Profil::class, 'update'])->name('Owner Profil Update');
        });

        Route::prefix('peralatan')->group(function () {
            Route::prefix('excavator')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'index'])->name('Owner Peralatan Excavator');
                Route::get('/tambah', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'create'])->name('Owner Peralatan Excavator Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'store'])->name('Owner Peralatan Excavator Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'show'])->name('Owner Peralatan Excavator Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'edit'])->name('Owner Peralatan Excavator Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'update'])->name('Owner Peralatan Excavator Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'destroy'])->name('Owner Peralatan Excavator Destroy');
            });

            Route::prefix('truk')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'index'])->name('Owner Peralatan Truk');
                Route::get('/tambah', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'create'])->name('Owner Peralatan Truk Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'store'])->name('Owner Peralatan Truk Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'show'])->name('Owner Peralatan Truk Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'edit'])->name('Owner Peralatan Truk Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'update'])->name('Owner Peralatan Truk Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'destroy'])->name('Owner Peralatan Truk Destroy');
            });

            Route::prefix('operasional')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'index'])->name('Owner Peralatan Operasional');
                Route::post('/req', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'req'])->name('Owner Peralatan Operasional Req');
                Route::get('/tambah', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'create'])->name('Owner Peralatan Operasional Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'store'])->name('Owner Peralatan Operasional Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'show'])->name('Owner Peralatan Operasional Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'edit'])->name('Owner Peralatan Operasional Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'update'])->name('Owner Peralatan Operasional Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'destroy'])->name('Owner Peralatan Operasional Destroy');
            });
        });

        Route::prefix('kepegawaian')->group(function () {
            Route::prefix('pegawai')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'index'])->name('Owner Kepegawaian Pegawai');
                Route::get('/tambah', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'create'])->name('Owner Kepegawaian Pegawai Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'store'])->name('Owner Kepegawaian Pegawai Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'show'])->name('Owner Kepegawaian Pegawai Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'edit'])->name('Owner Kepegawaian Pegawai Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'update'])->name('Owner Kepegawaian Pegawai Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'destroy'])->name('Owner Kepegawaian Pegawai Destroy');
            });

            Route::prefix('pinjaman')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'index'])->name('Owner Kepegawaian Pinjaman');
                Route::post('/req', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'req'])->name('Owner Kepegawaian Pinjaman Req');
                Route::get('/tambah', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'create'])->name('Owner Kepegawaian Pinjaman Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'store'])->name('Owner Kepegawaian Pinjaman Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'show'])->name('Owner Kepegawaian Pinjaman Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'edit'])->name('Owner Kepegawaian Pinjaman Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'update'])->name('Owner Kepegawaian Pinjaman Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'destroy'])->name('Owner Kepegawaian Pinjaman Destroy');
            });

            Route::prefix('gaji')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'index'])->name('Owner Kepegawaian Gaji');
                Route::post('/req', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'req'])->name('Owner Kepegawaian Gaji Req');
                Route::get('/tambah', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'create'])->name('Owner Kepegawaian Gaji Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'store'])->name('Owner Kepegawaian Gaji Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'show'])->name('Owner Kepegawaian Gaji Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'edit'])->name('Owner Kepegawaian Gaji Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'update'])->name('Owner Kepegawaian Gaji Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'destroy'])->name('Owner Kepegawaian Gaji Destroy');
            });
        });

        Route::prefix('gudang')->group(function () {
            Route::get('', [App\Http\Controllers\Owner\Gudang::class, 'index'])->name('Owner Gudang');
            Route::get('/tambah', [App\Http\Controllers\Owner\Gudang::class, 'create'])->name('Owner Gudang Create');
            Route::post('/tambah/action', [App\Http\Controllers\Owner\Gudang::class, 'store'])->name('Owner Gudang Store');
            Route::get('/{id}', [App\Http\Controllers\Owner\Gudang::class, 'show'])->name('Owner Gudang Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Gudang::class, 'edit'])->name('Owner Gudang Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Gudang::class, 'update'])->name('Owner Gudang Update');
            Route::post('/hapus', [App\Http\Controllers\Owner\Gudang::class, 'destroy'])->name('Owner Gudang Destroy');
        });

        Route::prefix('muatan')->group(function () {
            Route::get('', [App\Http\Controllers\Owner\Muatan::class, 'index'])->name('Owner Muatan');
            Route::get('/tambah', [App\Http\Controllers\Owner\Muatan::class, 'create'])->name('Owner Muatan Create');
            Route::post('/tambah/action', [App\Http\Controllers\Owner\Muatan::class, 'store'])->name('Owner Muatan Store');
            Route::get('/{id}', [App\Http\Controllers\Owner\Muatan::class, 'show'])->name('Owner Muatan Show');
            Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Muatan::class, 'edit'])->name('Owner Muatan Edit');
            Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Muatan::class, 'update'])->name('Owner Muatan Update');
            Route::post('/hapus', [App\Http\Controllers\Owner\Muatan::class, 'destroy'])->name('Owner Muatan Destroy');
        });

        Route::prefix('penjualan')->group(function () {
            Route::prefix('trip')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'index'])->name('Owner Penjualan Trip');
                Route::get('/tambah', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'create'])->name('Owner Penjualan Trip Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'store'])->name('Owner Penjualan Trip Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'show'])->name('Owner Penjualan Trip Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'edit'])->name('Owner Penjualan Trip Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'update'])->name('Owner Penjualan Trip Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'destroy'])->name('Owner Penjualan Trip Destroy');
            });

            Route::prefix('customer')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'index'])->name('Owner Penjualan Customer');
                Route::get('/tambah', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'create'])->name('Owner Penjualan Customer Create');
                Route::post('/tambah/action', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'store'])->name('Owner Penjualan Customer Store');
                Route::get('/{id}', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'show'])->name('Owner Penjualan Customer Show');
                Route::get('/{id}/invoice', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'invoice'])->name('Owner Penjualan Customer Invoice');
                Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'edit'])->name('Owner Penjualan Customer Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'update'])->name('Owner Penjualan Customer Update');
                Route::post('/hapus', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'destroy'])->name('Owner Penjualan Customer Destroy');
            });
        });

        Route::prefix('laporan')->group(function () {
            Route::prefix('pemasukan')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Laporan\Pemasukan::class, 'index'])->name('Owner Laporan Pemasukan');
            });

            Route::prefix('pengeluaran')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Laporan\Pengeluaran::class, 'index'])->name('Owner Laporan Pengeluaran');
            });
        });

        Route::prefix('tabel')->group(function () {
            Route::get('peralatan/excavator', [App\Http\Controllers\Owner\Peralatan\Excavator::class, 'dt'])->name('Owner Tabel Peralatan Excavator');
            Route::get('peralatan/truk', [App\Http\Controllers\Owner\Peralatan\Truk::class, 'dt'])->name('Owner Tabel Peralatan Truk');
            Route::get('peralatan/operasional', [App\Http\Controllers\Owner\Peralatan\Operasional::class, 'dt'])->name('Owner Tabel Peralatan Operasional');
            Route::get('kepegawaian/pegawai', [App\Http\Controllers\Owner\Kepegawaian\Pegawai::class, 'dt'])->name('Owner Tabel Kepegawaian Pegawai');
            Route::get('kepegawaian/pinjaman', [App\Http\Controllers\Owner\Kepegawaian\Pinjaman::class, 'dt'])->name('Owner Tabel Kepegawaian Pinjaman');
            Route::get('kepegawaian/gaji', [App\Http\Controllers\Owner\Kepegawaian\Gaji::class, 'dt'])->name('Owner Tabel Kepegawaian Gaji');
            Route::get('penjualan/trip', [App\Http\Controllers\Owner\Penjualan\Trip::class, 'dt'])->name('Owner Tabel Penjualan Trip');
            Route::get('penjualan/customer', [App\Http\Controllers\Owner\Penjualan\Customer::class, 'dt'])->name('Owner Tabel Penjualan Customer');
            Route::get('gudang', [App\Http\Controllers\Owner\Gudang::class, 'dt'])->name('Owner Tabel Gudang');
            Route::get('muatan', [App\Http\Controllers\Owner\Muatan::class, 'dt'])->name('Owner Tabel Muatan');
            Route::get('laporan/pemasukan/{awal}/{akhir}/{kategori}', [App\Http\Controllers\Owner\Laporan\Pemasukan::class, 'dt'])->name('Owner Tabel Laporan Pemasukan');
            Route::get('laporan/pengeluaran/{awal}/{akhir}/{kategori}', [App\Http\Controllers\Owner\Laporan\Pengeluaran::class, 'dt'])->name('Owner Tabel Laporan Pengeluaran');
        });
    });
});
