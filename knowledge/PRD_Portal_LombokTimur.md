# PRD — Portal Resmi Pemerintah Kabupaten Lombok Timur
**Versi:** 1.3  
**Tanggal:** Maret 2026  
**Stack:** Laravel 13 · Livewire 4 · Alpine.js · Tailwind CSS v4 · Filament v5

---

## 1. Gambaran Proyek

### 1.1 Latar Belakang
Portal yang ada saat ini (`portal.lomboktimurkab.go.id`) dibangun di atas CMS lama berbasis PHP tanpa framework modern. Tampilannya sudah ketinggalan zaman, tidak responsif secara optimal, dan tidak memiliki sistem manajemen konten yang terstruktur.

### 1.2 Tujuan
Membangun ulang portal pemerintah dengan:
- Desain modern, profesional, dan responsif (mobile-first)
- Performa tinggi (Lighthouse score ≥ 90)
- CMS yang mudah digunakan staf non-teknis (Filament v5)
- Keamanan standar pemerintah
- Aksesibilitas publik (WCAG 2.1 AA)

### 1.3 Desain Konsep: "Civic Modern"
| Elemen | Nilai |
|---|---|
| Warna Primer | Navy `#1B3B6F` |
| Warna Aksen | Gold `#C8960C` |
| Background | White / Light Gray `#F0F2F7` |
| Font Heading | Plus Jakarta Sans (Google Fonts) |
| Font Body | Inter |
| Border Radius | 10px (card), 6px (button) |

---

## 2. Tech Stack

### 2.1 Backend
| Teknologi | Versi | Keterangan |
|---|---|---|
| PHP | 8.3+ | Runtime environment |
| Laravel | 13.x | Framework utama |
| Livewire | 4.x | Reactive UI (include Alpine.js) |
| Filament | 5.x | Admin panel CMS |
| Laravel Scout | 11.x | Full-text search (Database Driver) |
| Spatie Media Library | 11.x | Upload & optimasi media |
| Spatie Permission | 6.x | Role & permission admin |
| Spatie Sitemap | 8.x | Auto-generate sitemap.xml |
| Spatie Sluggable | 3.x | Auto-generate slug |
| Maatwebsite Excel | 3.x | Import/export Excel |

### 2.2 Frontend
| Teknologi | Keterangan |
|---|---|
| Tailwind CSS v4 | Utility-first styling |
| Alpine.js | Include dalam Livewire 4 |
| Swiper.js | Hero slider, galeri |
| Chart.js | Infografis data daerah |

### 2.3 Database & Storage
| Teknologi | Keterangan |
|---|---|
| MySQL 8.x / PostgreSQL | Database utama |
| Redis | Cache & session |
| MinIO / S3 | Object storage untuk media |

### 2.4 DevOps & Tools
| Teknologi | Keterangan |
|---|---|
| Laravel Octane | Boost performa (Swoole/FrankenPHP) |
| Laravel Telescope | Debugging (dev only) |
| Laravel Horizon | Queue monitoring |
| Pest PHP | Testing |

---

## 3. Arsitektur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── BeritaController.php
│   │   ├── AgendaController.php
│   │   ├── PengumumanController.php
│   │   ├── LayananController.php
│   │   ├── WisataController.php
│   │   └── HargaPokokController.php
│   └── Middleware/
├── Livewire/
│   ├── HeroSlider.php
│   ├── BeritaTerbaru.php
│   ├── AgendaKegiatan.php
│   ├── HargaPokok.php
│   ├── StokDarah.php
│   ├── SearchBar.php
│   └── PengumumanList.php
├── Models/
│   ├── Berita.php
│   ├── Kategori.php
│   ├── Agenda.php
│   ├── Pengumuman.php
│   ├── Layanan.php
│   ├── Wisata.php
│   ├── HargaPokok.php
│   ├── StokDarah.php
│   ├── SliderHero.php
│   ├── QuickLink.php
│   ├── LinkBanner.php
│   └── User.php
└── Filament/
    └── Resources/
        ├── BeritaResource.php
        ├── AgendaResource.php
        ├── PengumumanResource.php
        ├── LayananResource.php
        ├── WisataResource.php
        ├── HargaPokokResource.php
        └── StokDarahResource.php

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php         # Main layout
│   │   └── partials/
│   │       ├── navbar.blade.php
│   │       └── footer.blade.php
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── berita/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── layanan/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── profil/
│   │   └── data/
│   └── livewire/
│       ├── hero-slider.blade.php
│       ├── berita-terbaru.blade.php
│       └── ...
└── css/
    └── app.css                   # Tailwind v4 entry
```

---

## 4. Database Schema

### 4.1 Tabel `berita`
```sql
- id (ulid, PK)
- judul (string)
- slug (string, unique)
- kategori_id (FK → kategoris)
- penulis_id (FK → users)
- konten (longtext)
- excerpt (text)
- thumbnail (string, nullable)
- status (enum: draft, published, archived)
- is_featured (boolean, default false)
- views (integer, default 0)
- published_at (timestamp, nullable)
- timestamps
```

### 4.2 Tabel `kategoris`
```sql
- id (pk)
- nama (string)
- slug (string, unique)
- warna (string, nullable)  -- hex color untuk badge
- timestamps
```

### 4.3 Tabel `agendas`
```sql
- id (pk)
- judul (string)
- deskripsi (text)
- jenis (enum: bupati, wabup, sekda)
- lokasi (string)
- tanggal (date)
- jam_mulai (time)
- jam_selesai (time, nullable)
- timestamps
```

### 4.4 Tabel `pengumumans`
```sql
- id (pk)
- judul (string)
- slug (string, unique)
- konten (longtext)
- file_lampiran (string, nullable)
- is_penting (boolean, default false)
- tanggal_terbit (date)
- tanggal_kadaluarsa (date, nullable)
- timestamps
```

### 4.5 Tabel `layanans`
```sql
- id (pk)
- nama (string)
- slug (string, unique)
- deskripsi (text)
- icon (string)
- url_eksternal (string, nullable)
- dinas_terkait (string)
- urutan (integer, default 0)
- is_active (boolean, default true)
- timestamps
```

### 4.6 Tabel `wisatas`
```sql
- id (pk)
- nama (string)
- slug (string, unique)
- deskripsi (longtext)
- lokasi (string)
- kecamatan (string)
- foto_utama (string)
- koordinat_lat (decimal 10,8, nullable)
- koordinat_lng (decimal 11,8, nullable)
- timestamps
```

### 4.7 Tabel `harga_poks`
```sql
- id (pk)
- nama_komoditi (string)
- satuan (string)
- harga (integer)
- tanggal_update (date)
- timestamps
```

### 4.8 Tabel `stok_darahs`
```sql
- id (pk)
- golongan (enum: A, B, AB, O)
- jumlah (integer)
- tanggal_update (date)
- timestamps
```

### 4.9 Tabel `slider_heros`
```sql
- id (pk)
- judul (string)
- subtitle (text, nullable)
- gambar (string)
- url_link (string, nullable)
- label_tombol (string, nullable)
- urutan (integer, default 0)
- is_active (boolean, default true)
- timestamps
```

### 4.10 Tabel `link_banners`
```sql
- id (pk)
- nama (string)
- url (string)
- gambar (string)
- urutan (integer, default 0)
- is_active (boolean, default true)
- timestamps
```

---

## 5. Halaman & Komponen

### 5.1 Halaman Publik

| Halaman | Route | Komponen Livewire |
|---|---|---|
| Beranda | `/` | HeroSlider, BeritaTerbaru, AgendaKegiatan, HargaPokok, StokDarah |
| Berita Index | `/berita` | BeritaList (filter, pagination) |
| Berita Detail | `/berita/{slug}` | — |
| Pengumuman | `/pengumuman` | PengumumanList |
| Layanan Index | `/layanan` | LayananGrid |
| Layanan Detail | `/layanan/{slug}` | — |
| Wisata | `/wisata` | WisataGallery |
| Profil | `/profil/{halaman}` | — |
| Data & Dokumen | `/data/{jenis}` | — |
| APBD | `/apbd/{tahun}` | — |
| Regulasi | `/regulasi` | RegulasiList |
| Pencarian | `/cari?q=...` | SearchResults |

### 5.2 Komponen Livewire Detail

**`HeroSlider`**
- Auto-play slider dengan thumbnail
- Tombol CTA per slide
- Dot indicator

**`BeritaTerbaru`**
- 1 berita utama besar + 5 berita sampingan
- Filter per kategori (real-time)
- Lazy load dengan pagination

**`AgendaKegiatan`**
- Tabs: Bupati / Wabup / Sekda
- Calendar view (opsional)
- Filter bulan

**`SearchBar`**
- Search dengan Laravel Scout (Database Driver)
- Autocomplete dropdown
- Highlight hasil pencarian

**`HargaPokok`**
- Tabel dinamis harga bahan pokok
- Tanggal update terakhir
- Indikator naik/turun harga (badge warna)

**`StokDarah`**
- 4 card golongan darah
- Real-time update (bisa via Reverb jika diinginkan)

---

## 6. Admin Panel (Filament v5)

### 6.1 Resources
- **BeritaResource** — CRUD berita, rich text editor (TipTap), upload thumbnail, set status, jadwal publish
- **AgendaResource** — CRUD agenda kegiatan, filter per jenis pejabat
- **PengumumanResource** — CRUD pengumuman, upload lampiran PDF
- **LayananResource** — CRUD layanan publik, drag & drop urutan
- **WisataResource** — CRUD wisata, upload multi-foto, koordinat maps
- **HargaPokokResource** — Update harga batch, import dari Excel (Maatwebsite Excel)
- **StokDarahResource** — Update stok darah PMI
- **SliderHeroResource** — Upload & urutan slider
- **LinkBannerResource** — Kelola link banner mitra
- **UserResource** — Manajemen admin (Spatie Permission)

### 6.2 Role & Permission
| Role | Akses |
|---|---|
| Super Admin | Full access |
| Admin Konten | Berita, Pengumuman, Agenda |
| Admin Layanan | Layanan, Wisata |
| Operator Harga | Harga Pokok, Stok Darah |
| Admin Media | Upload foto/dokumen saja |

### 6.3 Dashboard Widget Filament
- Total berita published bulan ini
- Total pengunjung (Google Analytics embed)
- Berita paling banyak dibaca
- Agenda kegiatan hari ini

---

## 7. Fitur Tambahan

### 7.1 SEO & Performance
- Meta title/description per halaman (via Spatie Laravel SEO)
- Open Graph tags untuk sharing sosmed
- Sitemap otomatis (Spatie Sitemap)
- Image optimization otomatis (Spatie Media Library WebP conversion)
- Route caching + config caching untuk produksi
- Redis untuk caching query berat (harga pokok, statistik)

### 7.2 Keamanan
- CSRF protection (bawaan Laravel)
- Rate limiting pada form aspirasi & pencarian
- Sanitasi input (DOMPurify + HTML Purifier)
- Filament 2FA untuk admin
- HTTPS mandatory
- Content Security Policy headers

### 7.3 Aksesibilitas
- Semantic HTML5 (nav, main, article, aside, footer)
- ARIA labels pada elemen interaktif
- Skip to main content link
- Ukuran font minimal 14px
- Contrast ratio ≥ 4.5:1 (WCAG AA)

### 7.4 Responsivitas
- Mobile-first CSS dengan Tailwind
- Breakpoints: sm(640px), md(768px), lg(1024px), xl(1280px)
- Navbar berubah menjadi hamburger menu di mobile
- Grid section menyesuaikan kolom otomatis

---

## 8. Rencana Pengembangan (6 Fase)

### Fase 1 — Setup & Fondasi (1 minggu)
- [x] Install Laravel 13 + konfigurasi environment
- [x] Setup Tailwind CSS v4 + Alpine.js (via Livewire 4)
- [x] Setup Filament v5 + Spatie packages
- [x] Install Laravel Scout (Database Driver)
- [x] Install Maatwebsite Excel
- [x] Setup database migrations (10 tabel)
- [x] Buat Eloquent models (10 models)
- [x] Buat Filament Resources (10 resources)
- [x] Buat seeders (User, Kategori, Layanan, StokDarah)
- [x] Buat layout utama (navbar, footer)
- [x] Konfigurasi storage (public disk, media library)

### Fase 2 — Halaman Beranda (1.5 minggu)
- [x] Komponen HeroSlider (Livewire + Swiper.js)
- [x] Stats Bar (statis / API)
- [x] Quick Access Grid
- [x] Section Berita Terbaru
- [x] Section Agenda Kegiatan (tabs)
- [x] Section Pengumuman
- [x] Section Harga Pokok + Stok Darah
- [x] Section Wisata Gallery
- [x] Footer lengkap

### Fase 3 — Halaman Dalam (1.5 minggu)
- [ ] Halaman Berita (index + detail)
- [ ] Halaman Pengumuman (index + detail)
- [ ] Halaman Layanan (index + detail)
- [ ] Halaman Profil (Sejarah, Visi Misi, SOTK)
- [ ] Halaman Data & Dokumen (APBD, LAKIP, dll)
- [ ] Halaman Regulasi
- [ ] Halaman Wisata
- [ ] Halaman Pencarian global

### Fase 4 — Admin Panel (1 minggu)
- [x] Semua Filament Resources (10 resources)
- [ ] Role & permission setup
- [ ] Dashboard widgets
- [ ] Import/export Excel (harga pokok)
- [ ] Rich text editor (TipTap) integrasi

### Fase 5 — SEO, Performance & Security (3 hari)
- [ ] Meta tags & Open Graph
- [ ] Sitemap otomatis
- [ ] Image optimization pipeline
- [ ] Redis caching setup
- [ ] Security headers
- [ ] Rate limiting
- [ ] Laravel Octane setup

### Fase 6 — Testing & Deploy (3 hari)
- [ ] Pest PHP unit & feature tests
- [ ] Lighthouse audit (target ≥ 90 semua kategori)
- [ ] Cross-browser testing
- [ ] Mobile responsiveness QA
- [ ] Migrasi konten dari portal lama
- [ ] Setup server produksi (Nginx + PHP-FPM 8.4)
- [ ] SSL certificate
- [ ] Domain pointing & go-live

---

## 9. Estimasi Waktu Total

| Fase | Durasi |
|---|---|
| Fase 1 — Setup & Fondasi | 7 hari |
| Fase 2 — Halaman Beranda | 10 hari |
| Fase 3 — Halaman Dalam | 10 hari |
| Fase 4 — Admin Panel | 7 hari |
| Fase 5 — Performance & Security | 3 hari |
| Fase 6 — Testing & Deploy | 3 hari |
| **Total** | **~40 hari kerja** |

---

## 10. Catatan Teknis Penting

1. **Livewire 4** — Filament 5 membutuhkan Livewire 4.x. Livewire4 sudah include Alpine.js secara otomatis, sehingga tidak perlu install terpisah. Fitur baru: single-file components, islands untuk performance, async actions.

2. **Filament v5** — Admin panel terbaik untuk Laravel, kompatibel dengan Laravel 11.28+ dan Laravel 13. Sudah include form builder, table builder, schemas, dan notification system. Sangat cocok untuk staf non-teknis. Menggunakan Tailwind CSS v4.1+.

3. **Laravel Scout Database Driver** — Dipilih karena estimasi data portal (< 50.000 record) masih cocok untuk database driver. Tidak membutuhkan service tambahan (Meilisearch/Typesense). Dapat di-upgrade ke Meilisearch di masa depan jika data sudah >100.000 record.

4. **Maatwebsite Excel** — Package standar untuk import/export Excel di Laravel. Digunakan untuk import data harga pokok dari file Excel.

5. **Image WebP** — Spatie Media Library otomatis convert semua upload ke WebP untuk performa lebih cepat.

6. **Cache Strategy** — Harga pokok dan stok darah di-cache Redis 1 jam. Berita di-cache 15 menit. Homepage sections di-cache 30 menit.

7. **ULID vs UUID** — Gunakan ULID untuk primary key (sortable, URL-friendly).

8. **Soft Delete** — Aktifkan soft delete pada tabel berita dan pengumuman agar konten yang dihapus bisa dipulihkan.

---

*Dokumen ini dapat diperbarui sesuai kebutuhan pengembangan. Diskusikan setiap perubahan scope sebelum implementasi.*
