# College Backend Deployment Checklist

## 1) Environment setup

- Copy environment file:
  - `cp .env.example .env` (Linux/macOS)
  - `copy .env.example .env` (Windows)
- Set production values in `.env`:
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_URL=https://your-domain.com`
  - MySQL credentials: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

## 2) Install dependencies

- `composer install --no-dev --optimize-autoloader`

## 3) App key, storage, and caches

- `php artisan key:generate`
- `php artisan storage:link`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## 4) Database migrate and seed

- `php artisan migrate --force`
- `php artisan db:seed --force`

## 5) API documentation

- Generate Swagger docs:
  - `php artisan l5-swagger:generate`
- Open docs at:
  - `/api/documentation`

## 6) Test before go-live (recommended in CI/staging)

- `php artisan test`

## 7) Post-deploy sanity checks

- Login works for Admin/Staff/Student.
- Admin dashboard loads analytics charts.
- Media upload works from Admin panel.
- Notifications and activity logs appear after admin CRUD actions.

