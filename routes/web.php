<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Pengumuman Routes
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');

// Layanan Routes
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');

// Wisata Routes
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{slug}', [WisataController::class, 'show'])->name('wisata.show');

// Profil Route
Route::get('/profil', function () {
    return view('pages.profil');
})->name('profil');

// Pencarian Route
Route::get('/pencarian', function () {
    return view('pages.pencarian');
})->name('pencarian');
