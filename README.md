# 3MAL Group Website

Marketing site and admin dashboard for 3MAL Group, built with PHP and MySQL. The public pages showcase services, case studies, listings, and blog posts, while the `/admin` area manages content (blog, listings, case studies, events, and form submissions).

## Stack
- PHP (PDO for MySQL, GD for image resize)
- MySQL
- jQuery + Bootstrap (via CDN), Swiper, AOS, CKEditor, Bootstrap Icons
- Plain CSS/JS served from `css/` and `js/` (no build step)

## Prerequisites
- PHP 7.4+ with `pdo_mysql`, `gd`, and `fileinfo` extensions enabled
- MySQL 5.7+/8.0
- Web server that can serve PHP (Apache/Nginx/PHP built-in server)
- Outbound network access (CDN assets and email delivery use external hosts)

## Setup
1. Clone the repo and place it in your web root.
2. Configure database credentials in `database/config.php`:
   ```php
   $host = 'localhost';
   $dbname = 'your_db';
   $username = 'your_user';
   $password = 'your_password';
   ```
   Consider moving secrets to environment variables before deploying.
3. Create the database schema (tables for blog, case studies, listings, events, webforms, etc.). There is no dump in the repo; review `admin/models/` queries to align table names/columns.
4. Ensure the web server user can write to upload directories used by the admin (e.g., `images/` and any subfolders referenced in the models).
5. If you need offline assets, download the CDN CSS/JS files referenced in `components/header.php` and point the links to local copies.

## Running locally
- Quick start with PHP’s built-in server from the project root:
  ```bash
  php -S localhost:8000
  ```
  Then open `http://localhost:8000`.
- For production, point your virtual host/docroot at the project root so `index.php` is the entry point.

## Admin area
- Main entry: `/admin/dashboard/`.
- Modules: Blog, Listings, Case studies, Events, Webforms, Settings.
- Authentication is session-based (`includes/session.php`); admin credentials are not stored in the repo—seed them directly in the database before first login.

## Project structure
- `index.php` — public homepage.
- `components/` — shared layout pieces (header, navbar, footer, admin partials).
- `includes/` — helpers (sessions, sanitization, email, image resize).
- `database/config.php` — PDO connection settings.
- `admin/` — admin UI and AJAX handlers under `admin/models/`.
- `css/`, `js/`, `images/` — static assets.
- `case-study/`, `blog/`, `contact/`, `reach-us/`, etc. — public-facing routes.

## Notes
- Email notifications use `mail()` with the HTML template in `includes/functions.php`; confirm SMTP is configured on the host.
- Absolute URLs in some templates point to `https://3malgroup.com`; adjust to environment-relative paths if needed.
