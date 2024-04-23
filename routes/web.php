<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('data-siswa', 'App\Http\Controllers\SiswaController');
    Route::resource('data-guru', 'App\Http\Controllers\GuruController');
    Route::resource('data-jenis-tagihan', 'App\Http\Controllers\JenisTagihanController');
    Route::resource('data-rincian-tagihan', 'App\Http\Controllers\RincianTagihanController');
    Route::resource('data-transaksi', 'App\Http\Controllers\TransactionController');
    Route::resource('data-tagihan-spp', 'App\Http\Controllers\PembayaranSppController');
    Route::resource('data-tagihan-Pendaftaran', 'App\Http\Controllers\PembayaranPendaftaranController');
    Route::resource('data-tagihan-kainSeragam', 'App\Http\Controllers\PembayaranKainSeragamController');
    Route::resource('data-tagihan-DaftarUlang', 'App\Http\Controllers\PembayaranDaftarUlangController');
    Route::resource('data-tagihan-lainnya', 'App\Http\Controllers\PembayaranLainnyaController');
    Route::resource('data-pendapatan', 'App\Http\Controllers\PendapatanController');
});

require __DIR__ . '/auth.php';
