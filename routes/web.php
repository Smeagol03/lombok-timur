<?php

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Wisata;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Berita Routes
Route::get('/berita', function () {
    return view('pages.berita.index');
})->name('berita.index');

Route::get('/berita/{slug}', function ($slug) {
    $berita = Berita::where('slug', $slug)->firstOrFail();

    // Increment view count
    $berita->increment('views');

    return view('pages.berita.show', compact('berita'));
})->name('berita.show');

// Pengumuman Routes
Route::get('/pengumuman', function () {
    return view('pages.pengumuman.index');
})->name('pengumuman.index');

Route::get('/pengumuman/{slug}', function ($slug) {
    $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

    return view('pages.pengumuman.show', compact('pengumuman'));
})->name('pengumuman.show');

// Layanan Routes
Route::get('/layanan', function () {
    return view('pages.layanan.index');
})->name('layanan.index');

Route::get('/layanan/{slug}', function ($slug) {
    $layanan = Layanan::where('slug', $slug)->firstOrFail();

    return view('pages.layanan.show', compact('layanan'));
})->name('layanan.show');

// Wisata Routes
Route::get('/wisata', function () {
    return view('pages.wisata.index');
})->name('wisata.index');

Route::get('/wisata/{slug}', function ($slug) {
    $wisata = Wisata::where('slug', $slug)->firstOrFail();

    return view('pages.wisata.show', compact('wisata'));
})->name('wisata.show');

// Profil Route
Route::get('/profil', function () {
    return view('pages.profil');
})->name('profil');

// Pencarian Route
Route::get('/pencarian', function () {
    return view('pages.pencarian');
})->name('pencarian');
