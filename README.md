# Campus Room Reservation System

Aplikasi peminjaman ruangan kampus berbasis Laravel + Livewire.

## Stack

- PHP 8.2+
- Laravel 12
- Livewire
- MySQL/MariaDB
- Node.js 18+

## Quick Deploy (Server Baru)

1. Clone repository

```bash
git clone https://github.com/Asrafil041/room.git
cd room
```

2. Install dependency

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Atur konfigurasi `.env`

- `APP_NAME`, `APP_ENV=production`, `APP_DEBUG=false`
- `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

5. Migrasi database

```bash
php artisan migrate --force
php artisan db:seed --force
```

6. Finalisasi permission dan cache

```bash
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Jalankan di Lokal

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

## Fitur Inti

- Booking ruangan kampus
- Dashboard admin
- Manajemen ruangan
- Notifikasi status reservasi
- Riwayat reservasi pengguna

## Catatan

- Untuk shared hosting, pastikan document root diarahkan ke folder `public`.
- Jangan commit file `.env` ke repository.
