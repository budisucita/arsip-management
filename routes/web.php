<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AnggotaController,
    UserController,
    KegiatanController,
    KeuanganController,
    SuratMasukController,
    SuratKeluarController,
    DokumentasiController,
    LaporanController
};

// 📌 Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// 📌 Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔒 Autentikasi & Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Admin saja
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/anggota', AnggotaController::class);
    Route::resource('/users', UserController::class);
});

Route::get('/test-role', function () {
    return 'Berhasil akses dengan role';
})->middleware(['auth', 'role:admin']);

// 🔓 Admin & Pengurus
Route::middleware(['auth', 'role:admin,pengurus'])->group(function () {
    Route::resource('/kegiatan', KegiatanController::class);
    Route::resource('/keuangan', KeuanganController::class);
    Route::resource('/surat-masuk', SuratMasukController::class);
    Route::resource('/surat-keluar', SuratKeluarController::class);
    Route::resource('/dokumentasi', DokumentasiController::class);
    
    
    // 📄 Laporan
    Route::get('/laporan/kegiatan', [LaporanController::class, 'kegiatan'])->name('laporan.kegiatan');
    Route::get('/laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');

    // 📄 Laporan PDF
    Route::get('/laporan/kegiatan/pdf', [LaporanController::class, 'exportKegiatanPDF'])->name('laporan.kegiatan.pdf');
    Route::get('/laporan/keuangan/pdf', [LaporanController::class, 'exportKeuanganPDF'])->name('laporan.keuangan.pdf');
});

require __DIR__.'/auth.php';