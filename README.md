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
php artisan storage:link

npm run build
php artisan serve
```

Then visit `http://localhost:8000`.

For active frontend development, run `npm run dev` in a separate terminal instead of `npm run build` to get hot-reloading.

## What's here

- **`Shop` model** (`app/Models/Shop.php`) — one shop per row, covering the curated ranking (`is_featured`), the wishlist (`status = want_to_visit`), and full blog-style entries (`body`, filled in once `status` is `visited`), including an optional cover photo (`cover_image`).
- **Public pages**: `/` (bio + favorite shops), `/reviews` (all visited shops), `/rankings` (numbered ranking of featured shops), `/wishlist` (shops not yet visited), `/shops/{shop}` (single shop write-up).
- **Admin** (`/admin/shops`, behind login): full CRUD for shops, including cover photo upload, plus a password-change page at `/admin/password`.
- **Login**: seeded admin account is `eloquent160@gmail.com` / `password` (Laravel's standard local-dev placeholder — change it from `/admin/password` after your first login, since this is a local-only dev database).

## Tests

```bash
php artisan test
```

## Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for running this on a Raspberry Pi behind
a Cloudflare Tunnel at `chlodny-blog.pl`.
