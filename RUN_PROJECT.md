# Run The Integrated Project

This project now has:

- Laravel backend in `D:\New folder\college-backend`
- React frontend source in `D:\New folder\college-backend\frontend`
- Built frontend bundle served by Laravel from `D:\New folder\college-backend\public\app`

## Prerequisites

- XAMPP installed at `C:\xampp`
- MySQL running on port `3307`
- Database name: `college_dashboard`

## Start The Backend

From:

`D:\New folder\college-backend`

Run:

```powershell
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

## Main URLs

- Frontend app: `http://127.0.0.1:8000/app`
- Admin login flow starts from frontend: `http://127.0.0.1:8000/app/login`
- Laravel admin dashboard: `http://127.0.0.1:8000/admin/dashboard`
- API base: `http://127.0.0.1:8000/api`

## Frontend Pages To Test

- Home: `/app`
- Services: `/app/services`
- About: `/app/about`
- Testimonials: `/app/testimonials`
- FAQ: `/app/faq`
- Blog: `/app/blog`
- Contact: `/app/contact`
- Book session: `/app/book-session`
- User login: `/app/login`
- Signup: `/app/signup`

## What Is Already Wired

- User signup -> `POST /api/auth/register`
- User login -> `POST /api/auth/login`
- Admin login -> `POST /admin/session-login`
- Contact form -> `POST /api/contact`
- Session booking form -> `POST /api/session-bookings`
- Services section -> `GET /api/services`
- Blog listing -> `GET /api/posts`
- Blog detail -> `GET /api/posts/{slug}`

## Database Changes Already Applied

These migrations have already been run:

- `2026_05_06_000001_add_phone_to_users_table`
- `2026_05_06_000002_create_contact_inquiries_table`
- `2026_05_06_000003_create_session_bookings_table`

## Rebuild Frontend If You Change React Files

From:

`D:\New folder\college-backend\frontend`

Run:

```powershell
node .\node_modules\vite\bin\vite.js build
```

This writes the production frontend back into:

`D:\New folder\college-backend\public\app`

## Suggested Manual Test Flow

1. Open `http://127.0.0.1:8000/app`
2. Check navigation across the public pages
3. Open signup and create a normal user account
4. Open login and test user login
5. Submit the contact form
6. Submit the book session form
7. Open `/app/blog`
8. If you have an admin or staff account, test admin login and open `/admin/dashboard`
