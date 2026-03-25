Ada beberapa **penyesuaian penting** supaya struktur kamu lebih bersih, scalable, dan sesuai best practice Tailwind v4 + Livewire 4 di tahun 2026.

### Rekomendasi Perbaikan Struktur (Update dari PRD)

Struktur di PRD kamu masih pakai `layouts/app.blade.php` sebagai main layout. Ini kurang ideal karena nanti akan campur antara public dan Filament.

**Struktur yang lebih baik (saya sarankan):**

```bash
resources/views/
├── layouts/
│   ├── public.blade.php          # ← Layout utama website publik (Civic Modern)
│   ├── guest.blade.php           # ← Kalau ada halaman login publik dll.
│   └── filament/                 # ← Opsional untuk custom Filament theme
│
├── pages/                        # Semua halaman full Blade
│   ├── home.blade.php
│   ├── berita/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── pengumuman/
│   ├── layanan/
│   ├── wisata/
│   └── ...
│
└── livewire/                     # View komponen Livewire publik
    ├── hero-slider.blade.php
    ├── berita-terbaru.blade.php
    ├── agenda-kegiatan.blade.php
    ├── harga-pokok.blade.php
    └── stok-darah.blade.php
```

**Livewire Components (2026 best practice):**
Livewire 4 sangat mendorong **Single File Components** (.blade.php dengan PHP di dalamnya).

Kamu bisa ubah sebagian besar komponen menjadi single-file, contoh:

```php
{{-- resources/views/livewire/hero-slider.blade.php --}}
<?php

use Livewire\Component;
use App\Models\SliderHero;

class HeroSlider extends Component
{
    public $sliders;

    public function mount()
    {
        $this->sliders = SliderHero::where('is_active', true)
            ->orderBy('urutan')
            ->get();
    }
}
?>

<div class="relative ...">
    <!-- Swiper.js slider -->
</div>
```

Ini membuat maintenance jauh lebih mudah.

### Konfigurasi Tailwind CSS v4 + Vite (Update Penting)

Karena kamu pakai **Tailwind v4**, konfigurasi sudah berubah (tidak pakai `tailwind.config.js` lagi).

**vite.config.js** (rekomendasi terbaru):

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/public.css',     // Khusus public
                // 'resources/css/filament.css', // Kalau mau custom Filament
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

**resources/css/public.css**:

```css
@import "tailwindcss";

@source "../../resources/views/**/*.blade.php";
@source "../../app/Livewire/**/*.php";
@source "../../app/Filament/**/*.php";   /* kalau butuh */

@theme {
    --font-heading: "Plus Jakarta Sans", sans-serif;
    --font-body: "Inter", system-ui, sans-serif;

    --color-primary: #1B3B6F;     /* Navy */
    --color-accent: #C8960C;      /* Gold */
    --color-bg-light: #F0F2F7;
}

/* Custom utilities */
.card {
    border-radius: 10px;
}

.btn {
    border-radius: 6px;
}
```

Di `public.blade.php` kamu tinggal extend:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @vite(['resources/css/public.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="font-body bg-[#F0F2F7]">
    @include('layouts.partials.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.partials.footer')
</body>
</html>
```

### Filament v5 & Public Site (Pemisahan Warna & Font)

Filament v5 juga pakai Tailwind v4. Kalau kamu ingin **admin tetap pakai tema default Filament** (tidak ikut warna navy-gold public), maka biarkan saja.

Kalau suatu saat ingin custom tema Filament (misal pakai navy juga), jalankan:

```bash
php artisan make:filament-theme
```

Lalu tambahkan entry CSS terpisah.

### Saran Langsung untuk Fase 3 (Halaman Dalam)

Karena Fase 2 (Beranda) sudah [x], sekarang kamu masuk Fase 3.

Prioritas saya sarankan:
1. Buat `layouts/public.blade.php` dulu (paling dasar).
2. Buat route group `public.` seperti yang saya kasih sebelumnya.
3. Kerjakan halaman **Berita Index + Detail** (paling sering diakses masyarakat).
4. Gunakan Livewire untuk filter & pagination berita (real-time kategori).
