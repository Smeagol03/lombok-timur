# Dokumentasi Audit Keamanan - Portal Lombok Timur

**Tanggal Audit:** 28 Maret 2026  
**Versi Aplikasi:** Laravel 13, Filament 5  
**Auditor:** Stakpak Security Audit  
**Status:** Siap untuk Production (dengan perbaikan)

---

## 📊 Ringkasan Eksekutif

**Security Score: 7.5/10** ⭐

Aplikasi Portal Lombok Timur memiliki fondasi keamanan yang **baik** dengan penggunaan:
- ✅ Eloquent ORM (aman dari SQL Injection)
- ✅ Blade auto-escaping (XSS protection)
- ✅ Laravel CSRF protection
- ✅ Spatie Media Library dengan mime validation
- ✅ Rate limiting yang terkonfigurasi
- ✅ Security headers (CSP, HSTS, X-Frame-Options)
- ✅ Role-based access control (Spatie Permission)

**Catatan Penting:** Aplikasi siap untuk production di Hostinger **asalkan** perbaikan kritis di bawah ini diselesaikan terlebih dahulu.

---

## 🔴 KRITIS - Harus Diperbaiki Sebelum Production

### 1. APP_DEBUG harus DIMATIKAN
**File:** `.env`  
**Status:** 🔴 **KRITIS**  
**Dampak:** Information disclosure, stack trace terexpose

**Konfigurasi Saat Ini:**
```env
APP_DEBUG=true  # ❌ BAHAYA
```

**Konfigurasi yang Harus Diterapkan:**
```env
APP_DEBUG=false  # ✅ AMAN
APP_ENV=production
APP_URL=https://lomboktimur.go.id  # Ganti dengan domain production
```

**Risiko jika tidak diperbaiki:**
- Full file paths terexpose
- Database queries terlihat
- Environment variables bocor
- Server configuration terexpose
- Memudahkan attacker untuk reconnaissance

---

### 2. Generate APP_KEY Baru untuk Production
**File:** `.env`  
**Status:** 🔴 **KRITIS**  
**Dampak:** Session hijacking, encryption compromise

**Perintah:**
```bash
php artisan key:generate --show
# Copy output ke APP_KEY di .env production
```

**Alasan:** APP_KEY saat ini mungkin sudah ter-commit di git history atau terexpose di environment lain.

---

### 3. Konfigurasi Database Production (MySQL)
**File:** `.env`  
**Status:** 🔴 **KRITIS**  
**Dampak:** Aplikasi tidak berjalan di production

**Konfigurasi Hostinger MySQL:**
```env
DB_CONNECTION=mysql
DB_HOST=localhost  # atau IP database Hostinger
DB_PORT=3306
DB_DATABASE=nama_database_hostinger
DB_USERNAME=username_hostinger
DB_PASSWORD=password_hostinger
```

**Catatan:** Saat ini masih menggunakan SQLite (`DB_CONNECTION=sqlite`) yang **tidak cocok** untuk production.

---

## 🟡 MEDIUM - Perbaikan Keamanan Lanjutan

### 4. Content Security Policy (CSP) Hardening
**File:** `app/Http/Middleware/SecurityHeaders.php`  
**Baris:** 30-37  
**Status:** 🟡 **MEDIUM**  
**Dampak:** XSS masih mungkin dengan inline scripts

**Kode Saat Ini (Terlalu Longgar):**
```php
$csp = "default-src 'self'; ";
$csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net; ";
$csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
```

**Kode yang Direkomendasikan:**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SecurityHeaders
{
    private static string $nonce;
    
    public static function getNonce(): string
    {
        if (!isset(self::$nonce)) {
            self::$nonce = base64_encode(Str::random(16));
        }
        return self::$nonce;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        $response->headers->remove('X-Powered-By');
        
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }
        
        if (!app()->environment('local')) {
            $nonce = self::getNonce();
            $csp = "default-src 'self'; ";
            $csp .= "script-src 'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net; ";
            $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
            $csp .= "font-src 'self' https://fonts.gstatic.com https://fonts.googleapis.com; ";
            $csp .= "img-src 'self' data: https:; ";
            $csp .= "connect-src 'self'; ";
            $csp .= "frame-ancestors 'self'; ";
            $csp .= "base-uri 'self'; ";
            $csp .= "form-action 'self';";
            
            $response->headers->set('Content-Security-Policy', $csp);
        }
        
        return $response;
    }
}
```

**Perubahan Utama:**
- Hapus `'unsafe-eval'` dari script-src
- Gunakan nonce untuk inline scripts
- Tambahkan `base-uri` dan `form-action` directives

---

### 5. Sanitasi Output RichEditor
**File:** `resources/views/pages/berita/show.blade.php` (dan view lain yang menampilkan konten)  
**Status:** ✅ **SELESAI**  
**Dampak:** Stored XSS prevention

**Solusi yang Diterapkan:**
- Custom HTML Sanitizer class (`app/Helpers/HtmlSanitizer.php`)
- Blade directive `@sanitized()` untuk sanitasi otomatis
- Menghapus script tags, event handlers, javascript: URLs
- Whitelist HTML tags dan attributes yang aman

---

### 6. Tambahkan Additional Security Middleware
**File Baru:** `app/Http/Middleware/AdditionalSecurity.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdditionalSecurity
{
    /**
     * Patterns yang diblokir untuk mencegah XSS dan injection
     */
    protected array $blockedPatterns = [
        '/<script[^>]*>.*?<\/script>/is',
        '/javascript:/i',
        '/on\w+\s*=\s*["\'][^"\']*["\']/i',
        '/<iframe/i',
        '/<object/i',
        '/<embed/i',
        '/eval\s*\(/i',
        '/expression\s*\(/i',
    ];
    
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Validasi input untuk common attack patterns
        $input = json_encode($request->all());
        
        foreach ($this->blockedPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                \Log::warning('Security: Suspicious input detected', [
                    'ip' => $request->ip(),
                    'url' => $request->url(),
                    'pattern' => $pattern,
                ]);
                
                abort(403, 'Suspicious input detected.');
            }
        }
        
        $response = $next($request);
        
        // Remove server fingerprinting headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        
        // Add cache control for sensitive pages
        if ($request->is('admin/*', 'filament/*')) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }
        
        return $response;
    }
}
```

**Register Middleware:**
**File:** `bootstrap/app.php`

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    $middleware->append(\App\Http\Middleware\AdditionalSecurity::class);
})
```

---

### 7. Enforce HTTPS di Production
**File:** `app/Providers/AppServiceProvider.php`

**Tambahkan di method `boot()`:**
```php
use Illuminate\Support\Facades\URL;

public function boot(): void
{
    $this->configureRateLimiting();
    
    // Force HTTPS di production
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
    
    View::composer('*', function ($view) {
        try {
            $setting = Setting::getInstance();
            $view->with('setting', $setting);
        } catch (\Exception $e) {
            $view->with('setting', null);
        }
    });
}
```

---

### 8. Rate Limiting untuk Admin Panel
**File:** `app/Providers/AppServiceProvider.php`  
**Status:** ✅ **SELESAI**  
**Dampak:** Brute force prevention

**Rate Limiters yang Diterapkan:**
```php
// Filament admin panel: 60 req/min
RateLimiter::for('filament', function (Request $request) {
    return Limit::perMinute(60)
        ->by($request->user()?->id ?: $request->ip());
});

// Login attempts: 5 req/min
RateLimiter::for('login', function (Request $request) {
    return Limit::perMinute(5)
        ->by($request->ip());
});
```

**Middleware Applied:**
- Admin panel: `throttle:filament` middleware di `AdminPanelProvider.php`
- Login: Built-in rate limiting dari Filament Login class

---

## 🟢 LOW - Perbaikan Minor

### 9. Cache Key Prefixing
**File:** `routes/web.php` (line 37)

**Sebelum:**
```php
Route::get('/sitemap.xml', fn () => Cache::remember('sitemap', 3600, function () {
```

**Sesudah:**
```php
Route::get('/sitemap.xml', fn () => Cache::remember('app:sitemap', 3600, function () {
```

---

### 10. Hapus X-Powered-By Header
Sudah ditangani di AdditionalSecurity middleware (poin #6).

---

## 📋 Checklist Pre-Deployment

### Environment Configuration
- [ ] Generate new APP_KEY
- [ ] Set APP_ENV=production
- [ ] Set APP_DEBUG=false
- [ ] Update APP_URL dengan domain production
- [ ] Konfigurasi MySQL database
- [ ] Set BCRYPT_ROUNDS=12 (sudah OK)
- [ ] Konfigurasi SMTP untuk email
- [ ] Set CACHE_STORE=database (atau redis jika tersedia)
- [ ] Set SESSION_DRIVER=database (atau redis jika tersedia)
- [ ] Set QUEUE_CONNECTION=database (atau redis jika tersedia)

### File Permissions
- [ ] `storage/` writable (755)
- [ ] `storage/app/public/` writable
- [ ] `bootstrap/cache/` writable
- [ ] `public/storage` symlink ke `storage/app/public`

### PHP Configuration (Hostinger)
- [ ] PHP >= 8.3
- [ ] `upload_max_filesize >= 2M`
- [ ] `post_max_size >= 8M`
- [ ] `memory_limit >= 256M`
- [ ] `max_execution_time >= 30`
- [ ] Enable OPcache
- [ ] Enable required extensions: pdo_mysql, mbstring, xml, ctype, json, tokenizer, fileinfo, gd/imagemagick

### Security
- [ ] Install dan konfigurasi HTML Purifier
- [ ] Update CSP middleware dengan nonce
- [ ] Deploy AdditionalSecurity middleware
- [ ] Enforce HTTPS
- [ ] Setup SSL certificate (Let's Encrypt atau Hostinger SSL)

### Deployment
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `php artisan event:cache`
- [ ] Run `php artisan migrate --force`
- [ ] Run `php artisan storage:link`
- [ ] Run `pnpm install && pnpm run build`

### Post-Deployment
- [ ] Test semua routes
- [ ] Test file upload
- [ ] Test admin panel login
- [ ] Test search functionality
- [ ] Verify SSL/HTTPS working
- [ ] Check error logs
- [ ] Setup monitoring (opsional)

---

## 🔍 Temuan Keamanan Detail

### SQL Injection Analysis
**Status:** ✅ **AMAN**

Semua query menggunakan Eloquent ORM dengan parameterized queries:
```php
// Aman - menggunakan parameter binding
Berita::where('slug', $slug)->firstOrFail();
Berita::published()->where('kategori_id', $this->kategori_id)->get();
```

Tidak ditemukan raw queries atau string concatenation dalam query.

---

### XSS (Cross-Site Scripting) Analysis
**Status:** ⚠️ **PERLU PERBAIKAN**

**Blade Templates:** ✅ Auto-escaping aktif
```blade
{{ $variable }}  <!-- Aman, auto-escaped -->
```

**RichEditor Content:** ⚠️ **RISIKO**
```blade
{!! $berita->konten !!}  <!-- Berbahaya jika tidak di-sanitize -->
```

**Solusi:** Gunakan HTML Purifier (lihat poin #5)

---

### File Upload Analysis
**Status:** ✅ **AMAN**

Spatie Media Library dengan validasi:
```php
->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
->maxSize(2048)  // 2MB
```

**Rekomendasi:** Pertimbangkan untuk menambahkan virus scanning untuk file uploads jika ada fitur upload dokumen di masa depan.

---

### Authentication & Authorization Analysis
**Status:** ✅ **BAIK**

- Menggunakan Laravel default authentication
- Spatie Permission untuk role-based access
- Password hashing dengan bcrypt
- Session management menggunakan database

**Roles yang terkonfigurasi:**
- Super Admin
- Admin Konten
- Admin Layanan
- Operator Harga
- Admin Media

---

### Rate Limiting Analysis
**Status:** ✅ **BAIK**

Rate limiters terkonfigurasi:
- `public`: 120 requests/minute
- `search`: 30 requests/minute
- `contact`: 5 requests/minute
- `api`: 60 requests/minute

**Rekomendasi:** Tambahkan rate limiting untuk admin panel (lihat poin #8)

---

## 🚨 Incident Response Plan

Jika terjadi security breach:

1. **Immediate Actions:**
   ```bash
   # Put aplikasi dalam maintenance mode
   php artisan down
   
   # Backup database dan logs
   mysqldump -u username -p database > backup-incident-$(date +%Y%m%d-%H%M%S).sql
   cp -r storage/logs logs-backup-$(date +%Y%m%d-%H%M%S)
   ```

2. **Assessment:**
   - Cek access logs di `storage/logs/laravel.log`
   - Identifikasi entry point serangan
   - Cek file yang dimodifikasi: `find . -type f -mtime -1`

3. **Recovery:**
   - Rotate APP_KEY: `php artisan key:generate`
   - Force logout semua user: `php artisan session:invalidate`
   - Clear cache: `php artisan cache:clear`
   - Scan malware: `clamscan -r .`

4. **Post-Incident:**
   - Update semua dependencies
   - Review dan perbaiki celah keamanan
   - Document lessons learned

---

## 📚 Referensi

- [Laravel Security Best Practices](https://laravel.com/docs/13.x/authentication)
- [OWASP Top 10 2021](https://owasp.org/www-project-top-ten/)
- [Filament Security](https://filamentphp.com/docs/3.x/panels/installation)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- [Content Security Policy](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP)

---

## 📝 Catatan untuk Developer

**Prioritas Pengerjaan:**
1. 🔴 Selesaikan semua item KRITIS (poin 1-3)
2. 🟡 Selesaikan item MEDIUM (poin 4-8)
3. 🟢 Selesaikan item LOW (poin 9-10)

**Testing Setelah Perbaikan:**
```bash
# Test security headers
curl -I https://lomboktimur.go.id

# Test XSS protection
curl "https://lomboktimur.go.id/pencarian?query=<script>alert(1)</script>"

# Test SQL injection
curl "https://lomboktimur.go.id/berita/1' OR '1'='1"

# Test rate limiting
curl -I "https://lomboktimur.go.id/berita/test-slug"
```

**Contact:** Jika ada pertanyaan tentang implementasi, konsultasikan dengan tim security atau DevOps.

---

**End of Document**
