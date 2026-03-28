# Portal Resmi Pemerintah Kabupaten Lombok Timur

**Dokumentasi Lengkap** — Versi 2.0  
*Last Updated: Maret 2026*

---

## 👨‍💻 Author

**Alpian Tabrani**  
📧 Email: [atabrani3@gmail.com](mailto:atabrani3@gmail.com)  
💻 GitHub: [@Smeagol03](https://github.com/Smeagol03)  
🌐 Website: [alpiant.my.id](https://alpiant.my.id)

---

## 📋 Daftar Isi

1. [Gambaran Umum](#gambaran-umum)
2. [Tech Stack](#tech-stack)
3. [Instalasi & Setup](#instalasi--setup)
4. [Struktur Folder](#struktur-folder)
5. [Database Schema](#database-schema)
6. [Routes & Pages](#routes--pages)
7. [Models & Relationships](#models--relationships)
8. [Admin Panel (Filament)](#admin-panel-filament)
9. [Livewire Components](#livewire-components)
10. [Frontend Pages](#frontend-pages)
11. [Commands & Artisan](#commands--artisan)
12. [Deployment](#deployment)
13. [Troubleshooting](#troubleshooting)

---

## 🎯 Gambaran Umum

Portal Resmi Pemerintah Kabupaten Lombok Timur adalah website informasi dan layanan publik yang dibangun dengan Laravel 13, Filament v5, dan Livewire 4. Website ini menyajikan:

- **Berita & Pengumuman** - Informasi terkini dari pemerintah daerah
- **Layanan Publik** - Direktori layanan online
- **Pariwisata** - Destinasi wisata di Lombok Timur
- **Data Publik** - Harga bahan pokok, stok darah, dll
- **Profil Daerah** - Informasi pemerintahan dan visi-misi

### Design Philosophy: "Civic Modern"

| Elemen | Value |
|--------|-------|
| **Primary Color** | Navy Blue `#1B3B6F` |
| **Accent Color** | Gold `#C8960C` |
| **Typography** | Plus Jakarta Sans (heading) + Inter (body) |
| **Design Style** | Swiss Design - Clean, asymmetric, typography-driven |

---

## 🛠 Tech Stack

### Backend

| Package | Versi | Fungsi |
|---------|-------|--------|
| **Laravel** | 13.x | Framework utama |
| **Livewire** | 4.x | Reactive UI components |
| **Filament** | 5.x | Admin panel CMS |
| **Laravel Scout** | 11.x | Full-text search (Database Driver) |
| **Spatie Media Library** | 11.x | Upload & manajemen media |
| **Spatie Permission** | 6.x | Role & permission system |
| **Spatie Sitemap** | 8.x | Auto-generate sitemap.xml |
| **Spatie Sluggable** | 3.x | Auto-generate slug URLs |
| **Maatwebsite Excel** | 3.x | Import/export Excel |

### Frontend

| Package | Fungsi |
|---------|--------|
| **Tailwind CSS v4** | Utility-first styling |
| **Alpine.js** | Include dalam Livewire 4 |
| **Swiper.js** | Hero slider & gallery |

### Database & Storage

| Teknologi | Fungsi |
|-----------|--------|
| **SQLite** | Development database |
| **MySQL 8.x** | Production database |
| **Redis** | Cache & session (optional) |
| **Local Storage** | Media files (public disk) |

### DevOps & Tools

| Package | Fungsi |
|---------|--------|
| **Laravel Boost** | AI development tools |
| **Laravel Pint** | Code formatter |
| **Pest PHP** | Testing framework |
| **Laravel Pail** | Log monitoring |

---

## 📦 Instalasi & Setup

### Requirements

- PHP 8.3+ dengan extensions: `pdo`, `mbstring`, `xml`, `curl`, `zip`, `gd`, `exif`, `intl`
- Composer
- Node.js 18+ & PNPM
- Git

### Quick Start

```bash
# 1. Clone repository
git clone <repository-url> lombok-timur
cd lombok-timur

# 2. Install dependencies
composer install
pnpm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Setup database (SQLite)
touch database/database.sqlite

# 5. Run migrations & seeders
php artisan migrate --seed

# 6. Build frontend assets
pnpm run build

# 7. Create storage symlink
php artisan storage:link

# 8. Start development server
composer run dev
```

### Default Admin Credentials

Setelah menjalankan seeders:

| Email | Password | Role |
|-------|----------|------|
| `admin@lomboktimurkab.go.id` | `password` | Super Admin |
| `content@lomboktimurkab.go.id` | `password` | Admin Konten |
| `layanan@lomboktimurkab.go.id` | `password` | Admin Layanan |
| `operator@lomboktimurkab.go.id` | `password` | Operator Harga |
| `media@lomboktimurkab.go.id` | `password` | Admin Media |

**⚠️ PENTING:** Ganti password default segera setelah instalasi!

---

## 📁 Struktur Folder

```
lombok-timur/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── BeritaController.php
│   │   │   ├── PengumumanController.php
│   │   │   ├── LayananController.php
│   │   │   ├── WisataController.php
│   │   │   └── HargaPokokController.php
│   │   └── Middleware/
│   │       ├── AdditionalSecurity.php
│   │       └── SecurityHeaders.php
│   ├── Livewire/
│   │   ├── LinkBanners.php
│   │   └── ... (hero-slider, berita-terbaru, dll via inline components)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Berita.php
│   │   ├── Kategori.php
│   │   ├── Agenda.php
│   │   ├── Pengumuman.php
│   │   ├── Layanan.php
│   │   ├── Wisata.php
│   │   ├── HargaPokok.php
│   │   ├── StokDarah.php
│   │   ├── SliderHero.php
│   │   ├── LinkBanner.php
│   │   ├── Setting.php
│   │   └── StokDarah.php
│   └── Filament/
│       └── Resources/
│           ├── Beritas/BeritaResource.php
│           ├── Agendas/AgendaResource.php
│           ├── Pengumumen/PengumumanResource.php
│           ├── Layanans/LayananResource.php
│           ├── Wisatas/WisataResource.php
│           ├── HargaPokoks/HargaPokokResource.php
│           ├── StokDarahs/StokDarahResource.php
│           ├── SliderHeroes/SliderHeroResource.php
│           ├── LinkBanners/LinkBannerResource.php
│           ├── Kategoris/KategoriResource.php
│           ├── Users/UserResource.php
│           └── Settings/SettingResource.php
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── PermissionSeeder.php
│   │   ├── BeritaSeeder.php
│   │   ├── HargaPokokSeeder.php
│   │   └── ...
│   └── factories/
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── components/
│   │   │   ├── layouts/
│   │   │   │   └── app.blade.php
│   │   │   └── partials/
│   │   │       ├── navbar.blade.php
│   │   │       ├── footer.blade.php
│   │   │       └── topbar.blade.php
│   │   │       └── ⚡*.blade.php (inline Livewire components)
│   │   ├── pages/
│   │   │   ├── home.blade.php
│   │   │   ├── profil.blade.php
│   │   │   ├── pencarian.blade.php
│   │   │   ├── berita/
│   │   │   ├── layanan/
│   │   │   └── wisata/
│   │   └── livewire/
│   │       └── link-banners.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
│
├── routes/
│   ├── web.php
│   └── console.php
│
├── public/
│   ├── build/ (Vite assets)
│   └── storage (symlink)
│
└── knowledge/
    ├── PRD_Portal_LombokTimur.md
    ├── DEPLOYMENT.md
    └── dokumentasi-keamanan.md
```

---

## 🗄 Database Schema

### Tabel Utama

#### `berita`
```sql
- id (ulid, PK)
- judul (string)
- slug (string, unique)
- kategori_id (FK → kategoris)
- penulis_id (FK → users)
- konten (longtext)
- excerpt (text)
- status (enum: draft, published, archived)
- is_featured (boolean)
- published_at (timestamp)
- timestamps
- deleted_at (soft delete)
```

#### `kategoris`
```sql
- id (ulid, PK)
- nama (string)
- slug (string, unique)
- warna (string, nullable)
- timestamps
```

#### `agendas`
```sql
- id (ulid, PK)
- judul (string)
- deskripsi (text)
- jenis (enum: bupati, wabup, sekda)
- lokasi (string)
- tanggal (date)
- jam_mulai (time)
- jam_selesai (time, nullable)
- timestamps
```

#### `pengumumans`
```sql
- id (ulid, PK)
- judul (string)
- slug (string, unique)
- konten (longtext)
- is_penting (boolean)
- tanggal_terbit (date)
- timestamps
```

#### `layanans`
```sql
- id (ulid, PK)
- nama (string)
- slug (string, unique)
- deskripsi (text)
- icon (string)
- icon_type (enum: icon, image)
- url_eksternal (string, nullable)
- dinas_terkait (string)
- urutan (integer)
- is_active (boolean)
- timestamps
```

#### `wisatas`
```sql
- id (ulid, PK)
- nama (string)
- slug (string, unique)
- deskripsi (longtext)
- lokasi (string)
- kecamatan (string)
- koordinat_lat (decimal, nullable)
- koordinat_lng (decimal, nullable)
- timestamps
```

#### `harga_poks`
```sql
- id (ulid, PK)
- nama_komoditi (string)
- satuan (string)
- harga (integer)
- tanggal_update (date)
- timestamps
```

#### `stok_darahs`
```sql
- id (ulid, PK)
- golongan (enum: A, B, AB, O)
- jumlah (integer)
- tanggal_update (date)
- timestamps
```

#### `slider_heros`
```sql
- id (ulid, PK)
- judul (string)
- subtitle (text, nullable)
- url_link (string, nullable)
- url_type (enum: internal, external)
- url_link_external (string, nullable)
- label_tombol (string, nullable)
- urutan (integer)
- is_active (boolean)
- timestamps
```

#### `link_banners`
```sql
- id (ulid, PK)
- nama (string)
- url (string)
- url_type (enum: internal, external)
- url_external (string, nullable)
- description (string, 100 chars)
- icon (string, nullable)
- gambar (string, nullable)
- urutan (integer)
- is_active (boolean)
- timestamps
```

#### `settings`
```sql
- id (integer, PK)
- site_name (string)
- site_tagline (string)
- site_description (text)
- meta_title (string)
- meta_description (text)
- meta_keywords (text)
- contact_phone (string)
- contact_email (string)
- contact_address (text)
- social_facebook (string)
- social_instagram (string)
- social_twitter (string)
- social_youtube (string)
- timestamps
```

### Media Library Tables (Spatie)

- `media` - Menyimpan semua uploaded files
- `model_has_media` - Polymorphic relationship

### Permission Tables (Spatie)

- `roles` - Role names (Super Admin, Admin Konten, dll)
- `permissions` - Permission names
- `model_has_roles` - User-role assignment
- `model_has_permissions` - Direct permission assignment
- `role_has_permissions` - Role-permission assignment

---

## 🛣 Routes & Pages

### Public Routes (`routes/web.php`)

| Method | Route | Controller | View | Deskripsi |
|--------|-------|------------|------|-----------|
| GET | `/` | HomeController | `pages/home` | Homepage |
| GET | `/profil` | - | `pages/profil` | Profil daerah |
| GET | `/layanan` | LayananController | `pages/layanan/index` | List layanan |
| GET | `/layanan/{slug}` | LayananController | `pages/layanan/show` | Detail layanan |
| GET | `/wisata` | WisataController | `pages/wisata/index` | List wisata |
| GET | `/wisata/{slug}` | WisataController | `pages/wisata/show` | Detail wisata |
| GET | `/harga-pokok` | HargaPokokController | `pages/harga-pokok` | Harga bahan pokok |
| GET | `/berita` | BeritaController | `pages/berita/index` | List berita |
| GET | `/berita/{slug}` | BeritaController | `pages/berita/show` | Detail berita |
| GET | `/pengumuman` | PengumumanController | `pages/pengumuman/index` | List pengumuman |
| GET | `/pengumuman/{slug}` | PengumumanController | `pages/pengumuman/show` | Detail pengumuman |
| GET | `/pencarian` | - | `pages/pencarian` | Halaman pencarian |

### Admin Routes (Filament)

Semua route admin dikelola otomatis oleh Filament di `/admin`:

```php
/admin/beritas
/admin/agendas
/admin/pengumumens
/admin/layanans
/admin/wisatas
/admin/harga-poks
/admin/stok-darahs
/admin/slider-heroes
/admin/link-banners
/admin/kategoris
/admin/users
/admin/settings
```

### Middleware

| Middleware | Fungsi |
|------------|--------|
| `throttle:public` | Rate limiting untuk halaman publik (60 req/menit) |
| `throttle:search` | Rate limiting ketat untuk pencarian (30 req/menit) |
| `panel:admin` | Autentikasi untuk admin panel |
| `AdditionalSecurity` | Custom security headers |
| `SecurityHeaders` | CSP, X-Frame-Options, dll |

---

## 🔗 Models & Relationships

### User
```php
- hasMany(Berita::class) - sebagai penulis
- belongsToMany(Role::class) - via Spatie Permission
```

### Berita
```php
- belongsTo(Kategori::class)
- belongsTo(User::class) - penulis
- hasMany(Media::class) - thumbnail via Spatie
```

### Kategori
```php
- hasMany(Berita::class)
```

### Layanan
```php
- hasMany(Media::class) - icon via Spatie
```

### Wisata
```php
- hasMany(Media::class) - foto_utama & galeri via Spatie
```

### SliderHero
```php
- hasMany(Media::class) - gambar via Spatie
```

### LinkBanner
```php
- hasMany(Media::class) - gambar via Spatie
```

### Setting
```php
- hasMany(Media::class) - logo & favicon via Spatie
```

---

## 🎛 Admin Panel (Filament)

### Resources (12 Total)

#### 1. BeritaResource
- **Form:** Title, slug (auto), kategori (select), penulis (select), konten (RichEditor), excerpt, status, featured toggle, publish date
- **Table:** Judul, kategori, penulis, status, featured badge, views, published date
- **Actions:** Create, Edit, Delete, Bulk Delete
- **Features:** Auto-slug, rich text editor (TipTap), image upload, schedule publish

#### 2. AgendaResource
- **Form:** Judul, deskripsi, jenis (select: bupati/wabup/sekda), lokasi, tanggal, jam mulai/selesai
- **Table:** Judul, jenis, tanggal, lokasi
- **Filters:** Jenis kegiatan, bulan

#### 3. PengumumanResource
- **Form:** Judul, slug, konten, lampiran (file upload), penting toggle, tanggal terbit
- **Table:** Judul, penting badge, tanggal terbit

#### 4. LayananResource
- **Form:** Nama, slug, deskripsi, icon (select Heroicons), icon type, URL eksternal, dinas terkait, urutan
- **Table:** Nama, icon, dinas, urutan, active toggle
- **Features:** Drag-to-reorder (via urutan)

#### 5. WisataResource
- **Form:** Nama, slug, deskripsi (RichEditor), lokasi, kecamatan, koordinat, foto upload
- **Table:** Nama, kecamatan, foto preview
- **Features:** Multi-image upload, map integration

#### 6. HargaPokokResource
- **Form:** Nama komoditi, satuan, harga, tanggal update
- **Table:** Komoditi, satuan, harga, tanggal update, perubahan harga badge
- **Actions:** Import Excel, Export Excel
- **Features:** Batch import via Maatwebsite Excel

#### 7. StokDarahResource
- **Form:** Golongan (select), jumlah, tanggal update
- **Table:** Golongan, jumlah, tanggal update

#### 8. SliderHeroResource
- **Form:** Judul, subtitle, gambar upload, URL type (internal/external), URL selector, label tombol, urutan, active toggle
- **Table:** Judul, gambar thumbnail, urutan, active toggle
- **Features:** Image upload, URL picker (internal pages dropdown)

#### 9. LinkBannerResource
- **Form:** Nama, URL type (internal/external), URL selector/external input, deskripsi (max 100 chars), icon selector, gambar upload, urutan, active toggle
- **Table:** Nama, icon, urutan, active toggle
- **Features:** Icon selector (12 social media icons), URL picker

#### 10. KategoriResource
- **Form:** Nama, slug, warna (color picker)
- **Table:** Nama, warna badge, jumlah berita

#### 11. UserResource
- **Form:** Nama, email, password, role assignment
- **Table:** Nama, email, role badge
- **Features:** Password reset, role management via Spatie

#### 12. SettingResource
- **Form:** Site info, meta tags, contact info, social media links, logo & favicon upload
- **Features:** Single instance (updateOrCreate)

### Dashboard Widgets

- Stats Overview: Total berita, pengumuman, layanan, wisata
- Recent Activities
- Quick stats (harga pokok summary)

---

## 🔌 Livewire Components

### Inline Components (Blade)

Komponen Livewire inline didefinisikan langsung di file Blade:

#### `⚡hero-slider.blade.php`
```php
// Lokasi: resources/views/components/⚡hero-slider.blade.php
- Slider otomatis dengan Swiper.js
- Data dari SliderHero model (active & ordered)
- Fitur: Autoplay 5s, fade effect, pagination fraction, navigation buttons
- LED ticker style untuk mobile
```

#### `⚡harga-pokok.blade.php`
```php
// Lokasi: resources/views/components/⚡harga-pokok.blade.php
- LED ticker untuk harga bahan pokok
- Data: 10 harga terbaru dengan perbandingan harga sebelumnya
- Fitur: Auto-scroll vertical, pause on hover, infinite loop
- Indikator: Naik (merah), Turun (hijau), Stabil (abu-abu)
```

### Class-based Components

#### `LinkBanners.php`
```php
// Lokasi: app/Livewire/LinkBanners.php
// View: resources/views/livewire/link-banners.blade.php
- Grid banner link media sosial & internal pages
- Pagination: 6 items per page
- Fitur: Icon selector, description, external/internal URL
```

---

## 🌐 Frontend Pages

### 1. Homepage (`pages/home.blade.php`)

**Sections:**
1. **Hero Slider** - Full-width slider dengan CTA buttons
2. **Quick Access / Layanan** - Grid 4 kolom layanan utama
3. **Berita Terbaru** - 1 berita utama + 5 berita sampingan
4. **Agenda Kegiatan** - Tabs: Bupati / Wabup / Sekda
5. **Data Publik** - Harga Pokok (LED ticker) + Stok Darah (cards)
6. **Wisata Gallery** - Grid destinasi wisata
7. **CTA Section** - Call center & link layanan
8. **Link Banners** - Social media & external links (pagination)

### 2. Profil Page (`pages/profil.blade.php`)

**Sections:**
1. **Hero Section** - Swiss design dengan quick stats panel
2. **Gambaran Umum** - Deskripsi kabupaten
3. **Visi & Misi** - Grid cards dengan hover effect
4. **Kontak & Informasi** - Contact cards dengan icon

### 3. Berita Pages

**Index:** Filter per kategori, search, pagination  
**Detail:** Konten lengkap, related berita, share buttons

### 4. Layanan Pages

**Index:** Grid layanan dengan icon  
**Detail:** Informasi layanan, link eksternal (jika ada)

### 5. Wisata Pages

**Index:** Gallery grid dengan filter kecamatan  
**Detail:** Foto galeri, koordinat maps, deskripsi lengkap

### 6. Harga Pokok Page (`pages/harga-pokok.blade.php`)

**Features:**
- Hero section dengan quick stats panel
- Table dengan 51 komoditi (1 per item)
- Perubahan harga vs periode sebelumnya
- Info card dengan catatan

---

## ⚡ Commands & Artisan

### Development Commands

```bash
# Start development (concurrent: server, queue, logs, vite)
composer run dev

# Alternative: Manual start
php artisan serve          # Server
php artisan queue:listen   # Queue worker
php artisan pail          # Log monitor
pnpm run dev              # Vite HMR

# Run tests
composer test

# Format code
vendor/bin/pint

# Clear cache
php artisan optimize:clear

# Rebuild assets
pnpm run build
```

### Database Commands

```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Fresh install
php artisan migrate:fresh --seed

# Specific seeder
php artisan db:seed --class=HargaPokokSeeder
```

### Admin Commands

```bash
# Create admin user (via tinker)
php artisan tinker
>>> \App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);
>>> \Spatie\Permission\Models\Role::findByName('Super Admin')->users()->attach($user);

# Clear permission cache
php artisan cache:forget spatie.permission.cache
```

### Media Commands

```bash
# Regenerate media thumbnails
php artisan medialibrary:regenerate

# Clear orphaned media
php artisan medialibrary:clean
```

### SEO Commands

```bash
# Generate sitemap (auto via route)
curl http://localhost/sitemap.xml

# Clear sitemap cache
php artisan cache:forget app:sitemap
```

---

## 🚀 Deployment

### Production Checklist

#### 1. Environment Setup
```bash
# .env configuration
APP_ENV=production
APP_DEBUG=false
APP_URL=https://lomboktimurkab.go.id

# Database (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=lombok_timur
DB_USERNAME=your_user
DB_PASSWORD=your_password

# Cache & Session
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

#### 2. Install & Build
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader --classmap-authoritative
pnpm install
pnpm run build

# Setup database
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create symlink
php artisan storage:link
```

#### 3. Supervisor Config (Queue Worker)

`/etc/supervisor/conf.d/lombok-timur.conf`:
```ini
[program:lombok-timur-queue]
command=php /var/www/lombok-timur/artisan queue:work --stop-when-empty
numprocs=1
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/lombok-timur/storage/logs/queue.log
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start lombok-timur-queue
```

#### 4. Cron Job (Scheduler)

```bash
crontab -e
```

Tambahkan:
```
* * * * * cd /var/www/lombok-timur && php artisan schedule:run >> /dev/null 2>&1
```

#### 5. Nginx Configuration

```nginx
server {
    listen 80;
    server_name lomboktimurkab.go.id www.lomboktimurkab.go.id;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name lomboktimurkab.go.id www.lomboktimurkab.go.id;

    root /var/www/lombok-timur/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/lomboktimurkab.go.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/lomboktimurkab.go.id/privkey.pem;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

#### 6. SSL Certificate (Let's Encrypt)

```bash
sudo certbot --nginx -d lomboktimurkab.go.id -d www.lomboktimurkab.go.id
```

#### 7. File Permissions

```bash
sudo chown -R www-data:www-data /var/www/lombok-timur
sudo chmod -R 755 /var/www/lombok-timur
sudo chmod -R 775 /var/www/lombok-timur/storage
sudo chmod -R 775 /var/www/lombok-timur/bootstrap/cache
```

---

## 🔧 Troubleshooting

### Common Issues

#### 1. 500 Error After Deployment
```bash
# Check permissions
chmod -R 775 storage bootstrap/cache

# Clear cache
php artisan optimize:clear
php artisan optimize

# Check logs
tail -f storage/logs/laravel.log
```

#### 2. Media Upload Failing
```bash
# Check symlink
ls -la public/storage

# Create if not exists
php artisan storage:link

# Check permissions
chmod -R 775 storage/app/public
```

#### 3. CSS/JS Not Loading
```bash
# Rebuild assets
pnpm run build

# Check manifest
cat public/build/manifest.json
```

#### 4. Queue Not Processing
```bash
# Check supervisor status
sudo supervisorctl status

# Restart worker
sudo supervisorctl restart lombok-timur-queue

# Check logs
tail -f storage/logs/queue.log
```

#### 5. Permission Cache Issue
```bash
# Clear Spatie permission cache
php artisan cache:forget spatie.permission.cache

# Or via tinker
php artisan tinker
>>> app()['cache']->forget('spatie.permission.cache');
```

#### 6. Search Not Working
```bash
# Reindex Scout
php artisan scout:import "App\Models\Berita"

# Check Scout driver
php artisan tinker
>>> config('scout.driver')
```

### Debugging Commands

```bash
# List all routes
php artisan route:list

# Check config
php artisan config:show app

# Tinker (interactive shell)
php artisan tinker

# Check database
php artisan db:show

# Validate env
php artisan env
```

---

## 📚 Additional Resources

### Documentation Links
- [Laravel 13 Docs](https://laravel.com/docs/13.x)
- [Filament v5 Docs](https://filamentphp.com/docs/5.x)
- [Livewire 4 Docs](https://livewire.laravel.com/docs)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary)
- [Spatie Permission](https://spatie.be/docs/laravel-permission)

### Knowledge Base
- `knowledge/PRD_Portal_LombokTimur.md` - Product Requirements Document
- `knowledge/DEPLOYMENT.md` - Deployment checklist
- `knowledge/dokumentasi-keamanan.md` - Security documentation

---

## 📞 Support

Untuk pertanyaan atau bantuan teknis, hubungi:

**Alpian Tabrani** - Lead Developer  
📧 Email: [atabrani3@gmail.com](mailto:atabrani3@gmail.com)  
💻 GitHub: [@Smeagol03](https://github.com/Smeagol03)  
🌐 Website: [alpiant.my.id](https://alpiant.my.id)

---

*© 2026 Alpian Tabrani. Dibuat dengan ❤️ menggunakan Laravel, Filament, & Livewire.*

*Project: Portal Resmi Pemerintah Kabupaten Lombok Timur*
