# Laravel E‑Commerce Store

A simple e-commerce store built with Laravel, featuring product browsing, search/sorting, cart, checkout & orders flow, and an admin panel powered by Filament.

---

## Features

### Store (User Side)
- Product listing with category filter
- Search (`q`) and sorting (`sort`: newest / price low-to-high / price high-to-low)
- Product details page
- Cart:
  - Add to cart with stock validation
  - Increase/decrease quantity, remove items, clear cart
  - Cart items count badge in the navbar
- Checkout & Orders:
  - Place orders using DB transactions
  - Stock deduction with concurrency protection (`lockForUpdate`)
  - Cart is cleared after a successful order
- My Orders:
  - Paginated orders list
  - Order details page with status badges

### Admin Panel (Filament)
- Orders management (OrderResource)
  - View order details and items
  - Update order status
- Admin dashboard widgets
  - Orders stats / Revenue stats
  - Latest orders table
- Products & Categories management (CRUD)

---

## Tech Stack
- Laravel
- Blade
- Laravel Breeze (Authentication + Profile)
- Filament (Admin Panel)
- MySQL (or any Laravel-supported database)

---

## Requirements
- PHP >= 8.2
- Composer
- Node.js + npm
- Database (MySQL/MariaDB recommended)

---

## Installation

### 1) Clone the repository
```bash
git clone https://github.com/<username>/<repo>.git
cd <repo>
2) Install backend dependencies
bash
composer install
3) Environment setup
bash
cp .env.example .env
php artisan key:generate
Update your database credentials in .env:

DB_DATABASE
DB_USERNAME
DB_PASSWORD
4) Run migrations (and seed if available)
bash
php artisan migrate
# If seeders exist:
# php artisan migrate --seed
5) Install frontend dependencies and build assets
bash
npm install
npm run build
# For development:
# npm run dev
6) Start the application
bash
php artisan serve
App will be available at:

http://127.0.0.1:8000
Admin Panel (Filament)
Access URL
/admin
Create an admin user
bash
php artisan make:filament-user
Notes
Stock is validated both when adding items to the cart and during checkout.
Checkout uses DB::transaction() and lockForUpdate() to prevent race conditions and ensure correct stock handling.
Category links and the search/sort form preserve query parameters (q, sort) for a better UX.
High-Level Project Structure
app/Http/Controllers/StoreController.php
app/Http/Controllers/CartController.php
app/Http/Controllers/CheckoutController.php
app/Http/Controllers/OrderController.php
resources/views/products/*
resources/views/cart/index.blade.php
resources/views/checkout/show.blade.php
resources/views/orders/*
app/Filament/* (Resources, Relation Managers, Widgets)
License
This project is intended for learning/demo purposes. Add your preferred license (e.g., MIT) if needed.