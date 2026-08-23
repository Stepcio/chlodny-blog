# Chłodny Blog 🍦

A running list of the best ice cream shops in Warsaw, plus a write-up for every shop visited along the way. Built with Laravel, Blade, and Tailwind CSS.

## Requirements

- PHP 8.4+ with the `openssl`, `mbstring`, `pdo_sqlite`, `sqlite3`, `curl`, `zip`, `fileinfo`, and `gd` extensions enabled
- Composer
- Node.js 20+ and npm

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --seed

npm run build
php artisan serve
```

Then visit `http://localhost:8000`.

For active frontend development, run `npm run dev` in a separate terminal instead of `npm run build` to get hot-reloading.

## What's here

- **`Shop` model** (`app/Models/Shop.php`) — one shop per row, covering both the curated "best of" list (`is_featured`) and full blog-style entries (`body`, filled in once `status` is `visited`).
- **Routes**: `/` (featured shops), `/shops` (full list), `/shops/{shop}` (single shop write-up).
- **Content**: for now, shops are added/edited via `database/seeders/ShopSeeder.php` or `php artisan tinker` — no admin UI yet.

## Tests

```bash
php artisan test
```
