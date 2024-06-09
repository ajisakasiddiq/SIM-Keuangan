<?php

use App\Http\Controllers\DetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\Rekap\RekapitulasiPendapatanController;
use App\Http\Controllers\Rekap\RekapitulasiPengeluaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaRegulerController;

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

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::resource('dashboard', 'App\Http\Controllers\DashboardController');
Route::resource('profile', 'App\Http\Controllers\ProfileController');
Route::middleware('auth', 'role:bendahara-excellent,bendahara-reguler')
    ->group(function () {
        Route::resource('data-guru', 'App\Http\Controllers\GuruController');
        Route::resource('data-jenis-tagihan', 'App\Http\Controllers\JenisTagihanController');
        Route::resource('data-rekening', 'App\Http\Controllers\RekeningController');
        Route::resource('data-transaksi', 'App\Http\Controllers\TransactionController');
        Route::resource('data-tagihan-spp', 'App\Http\Controllers\PembayaranSppController');
        Route::resource('data-tagihan-Pendaftaran', 'App\Http\Controllers\PembayaranPendaftaranController');
        Route::resource('data-tagihan-kainSeragam', 'App\Http\Controllers\PembayaranKainSeragamController');
        Route::resource('data-tagihan-DaftarUlang', 'App\Http\Controllers\PembayaranDaftarUlangController');
        Route::resource('data-tagihan-lainnya', 'App\Http\Controllers\PembayaranLainnyaController');
        Route::resource('data-pendapatan', 'App\Http\Controllers\PendapatanController');
        Route::resource('data-danabos', 'App\Http\Controllers\DanaBosController');
        Route::resource('data-pengeluaran', 'App\Http\Controllers\PengeluaranController');
        Route::resource('Laporan-Keuangan', 'App\Http\Controllers\LaporanKeuanganController');
        Route::resource('Rekapitulasi-pengeluaran', 'App\Http\Controllers\Rekap\RekapitulasiPengeluaranController');
        Route::resource('Rekapitulasi-pendapatan', 'App\Http\Controllers\Rekap\RekapitulasiPendapatanController');
        Route::resource('Details', 'App\Http\Controllers\DetailsController');
        Route::put('/details/update', [DetailsController::class, 'update'])->name('Detailsupdate');

        Route::get('/export-datalaporan', [LaporanKeuanganController::class, 'exportData'])->name('export.data');
        Route::get('/export-pendapatan', [RekapitulasiPendapatanController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export-data', [RekapitulasiPengeluaranController::class, 'exportExcel'])->name('export.pengeluaran');
    });
Route::middleware('auth', 'role:admin')
    ->group(function () {
        Route::post('/data-siswa-excellent/importExcel', [SiswaController::class, 'importData'])->name('data-siswa.importData');
        Route::post('/data-siswa-reguler/importExcel', [SiswaRegulerController::class, 'importData'])->name('data-siswa-reguler.importData');
        Route::resource('data-siswa-excellent', 'App\Http\Controllers\SiswaController');
        Route::resource('data-siswa-reguler', 'App\Http\Controllers\SiswaRegulerController');
        Route::resource('data-user', 'App\Http\Controllers\UserController');
        Route::resource('Tahun-Ajaran', 'App\Http\Controllers\TahunAjaranController');
        Route::post('/update-classes', [SiswaController::class, 'updateClasses'])->name('update.class');
    });
Route::middleware('auth', 'role:siswa')->group(function () {
    Route::resource('Tagihan-spp', 'App\Http\Controllers\Siswa\PembayaranSPPController');
    Route::resource('Tagihan-Pendaftaran', 'App\Http\Controllers\Siswa\PembayaranPendaftaranController');
    Route::resource('Tagihan-DaftarUlang', 'App\Http\Controllers\Siswa\PembayaranDaftarUlangController');
    Route::resource('Tagihan-Lainnya', 'App\Http\Controllers\Siswa\PembayaranLainnyaController');
    Route::resource('Tagihan-KainSeragam', 'App\Http\Controllers\Siswa\PembayaranKainSeragamController');
    Route::get('/cetak-spp/{id}', [App\Http\Controllers\Siswa\PembayaranSPPController::class, 'cetak'])->name('cetak.spp');
    Route::get('/cetak-nota/{id}', [App\Http\Controllers\Siswa\PembayaranPendaftaranController::class, 'cetak'])->name('cetak.pendaftaran');
});
require __DIR__ . '/auth.php';
