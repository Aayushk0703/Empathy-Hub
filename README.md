# Empathy-Hub

Empathy Hub is a mental wellness platform built with a Laravel backend and a React frontend.

## Project Structure

- `app/`, `routes/`, `database/`: Laravel backend
- `frontend/`: React + Vite frontend source
- `public/app/`: built frontend served by Laravel

## Local Run

1. Start MySQL.
2. Configure `.env`.
3. Run migrations:
   - `php artisan migrate`
4. Start Laravel:
   - `php artisan serve`

Frontend is available at:

- `/app`

## Notes

- Frontend assets are built into `public/app/`
- Additional project instructions are in `RUN_PROJECT.md`
