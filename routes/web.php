<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HargaPokokController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\WisataController;
use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Wisata;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::middleware(['throttle:public'])->group(function (): void {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profil', fn () => view('pages.profil'))->name('profil');
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
    Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
    Route::get('/wisata/{slug}', [WisataController::class, 'show'])->name('wisata.show');
    Route::get('/harga-pokok', [HargaPokokController::class, 'index'])->name('harga-pokok.index');
});

Route::middleware(['throttle:public'])->group(function (): void {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
});

Route::middleware(['throttle:search'])->group(function (): void {
    Route::get('/pencarian', fn () => view('pages.pencarian'))->name('pencarian');
});

Route::get('/sitemap.xml', fn () => Cache::remember('app:sitemap', 3600, function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(url('/'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0))
        ->add(Url::create(url('/berita'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9))
        ->add(Url::create(url('/pengumuman'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9))
        ->add(Url::create(url('/layanan'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8))
        ->add(Url::create(url('/wisata'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8))
        ->add(Url::create(url('/profil'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7))
        ->add(Url::create(url('/harga-pokok'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.8));

    Berita::published()
        ->latest('published_at')
        ->limit(1000)
        ->get()
        ->each(fn ($berita) => $sitemap->add(
            Url::create(url('/berita/'.$berita->slug))
                ->setLastModificationDate($berita->published_at ?? $berita->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        ));

    Pengumuman::published()
        ->latest('tanggal_terbit')
        ->limit(500)
        ->get()
        ->each(fn ($pengumuman) => $sitemap->add(
            Url::create(url('/pengumuman/'.$pengumuman->slug))
                ->setLastModificationDate($pengumuman->tanggal_terbit ?? $pengumuman->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7)
        ));

    Layanan::latest('updated_at')
        ->limit(100)
        ->get()
        ->each(fn ($layanan) => $sitemap->add(
            Url::create(url('/layanan/'.$layanan->slug))
                ->setLastModificationDate($layanan->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.6)
        ));

    Wisata::latest('updated_at')
        ->limit(100)
        ->get()
        ->each(fn ($wisata) => $sitemap->add(
            Url::create(url('/wisata/'.$wisata->slug))
                ->setLastModificationDate($wisata->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.6)
        ));

    return $sitemap;
})->toResponse(request()))->name('sitemap');

Route::get('/robots.txt', fn () => response(
    "User-agent: *\nAllow: /\nSitemap: ".url('/sitemap.xml')."\n",
    200,
    ['Content-Type' => 'text/plain']
))->name('robots');
