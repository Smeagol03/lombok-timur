# Deployment Checklist - Portal Lombok Timur

## Pre-Deployment

### 1. Server Requirements
- [ ] PHP 8.2+ dengan extensions: pdo, pdo_mysql, mbstring, xml, curl, zip, gd, exif, intl, bcmath, opcache
- [ ] MySQL 5.7+ atau MariaDB 10.3+
- [ ] Nginx atau Apache dengan mod_rewrite
- [ ] Composer
- [ ] Node.js 18+ & NPM/PNPM
- [ ] Git

### 2. Environment Setup
- [ ] Clone repository
- [ ] Copy `.env.example` to `.env`
- [ ] Generate APP_KEY: `php artisan key:generate`
- [ ] Configure database credentials
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_URL` to production URL
- [ ] Configure mail settings
- [ ] Set proper file permissions

### 3. Dependencies
```bash
composer install --no-dev --optimize-autoloader
pnpm install
pnpm build
```

### 4. Database Setup
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Storage & Cache
```bash
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 6. Queue Worker (if using)
```bash
php artisan queue:work --daemon
# Setup supervisor untuk auto-restart
```

### 7. Scheduler (Cron)
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## Post-Deployment

### 1. Security Checklist
- [ ] HTTPS enabled (SSL certificate)
- [ ] APP_DEBUG=false in production
- [ ] APP_KEY generated
- [ ] Database credentials secured
- [ ] File permissions correct (755 for folders, 644 for files)
- [ ] Storage folder writable
- [ ] .env file not accessible from web

### 2. Performance Optimization
- [ ] OPcache enabled
- [ ] Config cache: `php artisan config:cache`
- [ ] Route cache: `php artisan route:cache`
- [ ] View cache: `php artisan view:cache`
- [ ] Queue worker running (if applicable)

### 3. Media Library Setup
- [ ] Create `storage/app/public/media` folder
- [ ] Ensure writable permissions

### 4. Admin Panel Setup
- [ ] Access /admin
- [ ] Login with seeded admin credentials
- [ ] Change default admin password
- [ ] Create additional admin users as needed

### 5. Content Setup
- [ ] Replace dummy content with real content
- [ ] Upload hero slider images
- [ ] Upload wisata images
- [ ] Update contact information

---

## Cron Jobs (Add to crontab)

```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## Supervisor Config (for queue worker)

```ini
[program:lombok-timur-queue]
command=php /path-to-project/artisan queue:work --stop-when-empty
numprocs=1
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/path-to-project/storage/logs/queue.log
```

---

## Nginx Config Example

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name lomboktimurkab.go.id www.lomboktimurkab.go.id;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name lomboktimurkab.go.id www.lomboktimurkab.go.id;
    
    root /var/www/lombok-timur/public;
    index index.php index.html;
    
    ssl_certificate /etc/letsencrypt/live/lomboktimurkab.go.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/lomboktimurkab.go.id/privkey.pem;
    
    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
    
    # Static files caching
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

---

## Default Admin Credentials

After running seeders:
- **Email:** admin@lomboktimurkab.go.id
- **Password:** password (CHANGE IMMEDIATELY!)

---

## Troubleshooting

### Common Issues

1. **500 Error after deployment**
   - Check storage permissions: `chmod -R 775 storage bootstrap/cache`
   - Check .env file exists and is configured
   - Run `php artisan optimize:clear` and then `php artisan optimize`

2. **Media upload failing**
   - Check `storage/app/public` exists and is writable
   - Check `public/storage` symlink exists

3. **CSS/JS not loading**
   - Run `pnpm build`
   - Check Vite manifest exists in `public/build/manifest.json`

4. **Queue not processing**
   - Check supervisor is running
   - Check queue worker logs in `storage/logs/`

---

## Useful Commands

```bash
# Clear all cache
php artisan optimize:clear

# Cache everything
php artisan optimize

# Run queue worker
php artisan queue:work

# Check schedule
php artisan schedule:list

# Test email
php artisan tinker
>>> Mail::raw('Test email', fn($msg) => $msg->to('test@example.com')->subject('Test'));
```