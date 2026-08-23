# Deployment — Raspberry Pi + Cloudflare Tunnel

Runbook for putting the app on `ranking.chlodny-kacik.pl`, served from a
Raspberry Pi 4 at home. No port forwarding, no static IP needed: Cloudflare
Tunnel makes an outbound-only connection from the Pi to Cloudflare's edge,
which terminates TLS and proxies the public hostname to it. The bare domain
(`chlodny-kacik.pl`) is left unconfigured — it's reserved for the future
physical shop's own site.

Stack on the Pi: Nginx + PHP-FPM 8.3 + MariaDB (MySQL-wire-compatible,
lighter than Postgres/MySQL on a Pi's RAM, and in Raspberry Pi OS's own apt
repo) + cloudflared, all as systemd services.

## 0. Prerequisites

- Raspberry Pi OS (Bookworm or newer), reachable over SSH.
- A Cloudflare account (free plan is enough).
- Access to the chlodny-kacik.pl registrar account, to change nameservers.

Check the Pi's PHP version first:

```bash
php -v
```

If it's below 8.3 (Bookworm's default apt repo ships 8.2), add Sury's repo
before installing PHP below:

```bash
sudo apt update
sudo apt install -y apt-transport-https lsb-release ca-certificates curl
sudo curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" \
  | sudo tee /etc/apt/sources.list.d/php.list
sudo apt update
```

## 1. Install PHP, Composer, Node, Nginx, MariaDB

```bash
sudo apt install -y nginx mariadb-server \
  php8.3 php8.3-fpm php8.3-cli php8.3-mysql php8.3-mbstring \
  php8.3-xml php8.3-curl php8.3-zip php8.3-gd php8.3-bcmath

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

(If the socket path differs from `/run/php/php8.3-fpm.sock`, note it — you'll
need it in `deploy/nginx.conf`.)

## 2. Create the database

```bash
sudo mysql_secure_installation

sudo mysql -u root <<'SQL'
CREATE DATABASE chlodny_kacik CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'chlodny_kacik'@'localhost' IDENTIFIED BY 'CHANGE_ME';
GRANT ALL PRIVILEGES ON chlodny_kacik.* TO 'chlodny_kacik'@'localhost';
FLUSH PRIVILEGES;
SQL
```

Pick a real password instead of `CHANGE_ME` and keep it for step 4.

## 3. Clone the app and install dependencies

```bash
sudo mkdir -p /var/www/chlodny-kacik
sudo chown "$USER":"$USER" /var/www/chlodny-kacik
git clone https://github.com/Stepcio/chlodny-kacik.git /var/www/chlodny-kacik
cd /var/www/chlodny-kacik

composer install --no-dev --optimize-autoloader
npm ci
```

## 4. Configure `.env` for production

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```
APP_NAME="Chłodny Blog"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ranking.chlodny-kacik.pl

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chlodny_kacik
DB_USERNAME=chlodny_kacik
DB_PASSWORD=<the password from step 2>

QUEUE_CONNECTION=sync
```

(`QUEUE_CONNECTION=sync` — the app doesn't dispatch any queued jobs, so a
queue worker service would just be one more thing to babysit for no benefit.
`SESSION_DRIVER`/`CACHE_STORE` can stay `database`, no separate cache service
needed at this scale.)

## 5. Migrate, link storage, build assets

```bash
php artisan migrate --force
php artisan db:seed --force   # only if you want the seeded admin login
php artisan storage:link

npm run build

sudo chown -R www-data:www-data storage bootstrap/cache
```

## 6. Nginx + PHP-FPM

```bash
sudo cp deploy/nginx.conf /etc/nginx/sites-available/chlodny-kacik
sudo ln -s /etc/nginx/sites-available/chlodny-kacik /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t && sudo systemctl reload nginx
sudo systemctl enable --now php8.3-fpm
```

## 7. Point the domain at Cloudflare

1. In the Cloudflare dashboard, **Add a site** → `chlodny-kacik.pl` → free plan.
2. Cloudflare shows two nameservers. At your `.pl` registrar, replace the
   existing nameservers with those two. Propagation is usually under an
   hour, sometimes longer for `.pl`.
3. Wait until Cloudflare's dashboard shows the zone as **Active** before
   continuing.

## 8. Cloudflare Tunnel

```bash
curl -L https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-arm64.deb -o cloudflared.deb
sudo dpkg -i cloudflared.deb

cloudflared tunnel login   # opens a URL — open it on any device logged into your Cloudflare account
cloudflared tunnel create chlodny-kacik
```

Note the tunnel UUID it prints, then:

```bash
sudo mkdir -p /etc/cloudflared
sudo cp ~/.cloudflared/<TUNNEL_UUID>.json /etc/cloudflared/
sudo cp deploy/cloudflared-config.yml /etc/cloudflared/config.yml
sudo nano /etc/cloudflared/config.yml   # replace both <TUNNEL_UUID> placeholders

cloudflared tunnel route dns chlodny-kacik ranking.chlodny-kacik.pl

sudo cloudflared service install
sudo systemctl enable --now cloudflared
```

`route dns` creates the CNAME in Cloudflare automatically — no manual DNS
record needed. Cloudflare issues and manages TLS for the hostname; nothing
to configure for certificates.

## 9. Verify

```bash
systemctl status nginx php8.3-fpm mariadb cloudflared
curl -I http://127.0.0.1   # should return a Laravel response, not an error
```

Then visit `https://ranking.chlodny-kacik.pl` from anywhere. Log in at
`/login` (seeded admin, see README) and change the password at
`/admin/password` immediately since this is now a public site.

## Ongoing deploys

```bash
cd /var/www/chlodny-kacik
bash deploy/deploy.sh
```

Pulls `main`, reinstalls dependencies, rebuilds assets, runs migrations, and
recaches config/routes/views.

## Backups

MariaDB dump on a daily cron, kept off the Pi's own SD card:

```bash
mysqldump -u chlodny_kacik -p chlodny_kacik | gzip > backup-$(date +%F).sql.gz
```

Cover-photo uploads live under `storage/app/public` — back that up too, or
they're gone with the SD card.

## Troubleshooting

- **502 from Nginx**: PHP-FPM isn't running or the socket path in
  `deploy/nginx.conf` doesn't match `php -v`'s actual version.
- **Tunnel up but site unreachable**: check `sudo systemctl status
  cloudflared` and `sudo journalctl -u cloudflared -f`; confirm the zone
  shows Active in Cloudflare and `ingress.hostname` matches exactly.
- **Mixed content / http links**: confirm `APP_URL` is `https://` and
  `fastcgi_param HTTPS on;` is present in the Nginx vhost.
