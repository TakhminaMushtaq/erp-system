<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel ERP System

A lightweight ERP (Enterprise Resource Planning) system built with Laravel and Bootstrap. This system includes modules for inventory, sales orders, and dashboard analytics, designed for small to mid-scale businesses.

##  Features

  -  User authentication (Laravel Breeze + Bootstrap)
  - Product Management (CRUD)
  - Sales Order Management:
  - Add multiple products to sales orders
  - Automatic inventory reduction
  - Total calculation and validation
  - PDF export (using DomPDF)
  - Dashboard Analytics:
  - Total Sales Amount
  - Total Orders Count
  - Low Stock Alerts
  - Graphs: Daily and Weekly Sales Trends (Chart.js)
  - Role-based access control (Admin, User)
  - Clean UI using Bootstrap
  - Modular and extendable structure

---

## Folder Structure
app/
├── Http/
│ ├── Controllers/
│ ├── Middleware/
│ └── Requests/
├── Models/
resources/
├── views/
│ ├── products/
│ ├── sales_orders/
│ ├── dashboard.blade.php
routes/
├── web.php

---

## Installation

1. **Clone the repo**
```bash
git clone https://github.com/TakhminaMushtaq/erp-system.git
cd erp-system

# Install dependencies

composer install
npm install && npm run build

# Setup environment

cp .env.example .env
php artisan key:generate
Configure .env
Update DB credentials, mail, etc.

# Run migrations & seeders

php artisan migrate --seed

#Start development server

php artisan serve
http://127.0.0.1:8000/login

# User Roles
admin@example.com / Admin@123 (Admin role - can manage products, view dashboard, etc.)
salesperson@example.com / Sales@123 (Sales role - can manage sales and view dashboard)

You can update the default user in database/seeders/UserSeeder.php.

# Modules Overview
Products
Add, Edit, Delete products

Track stock quantity

SKU, Price, Quantity

Sales Orders
Create sales with multiple products

Validates stock availability

Auto calculation of total

Stock deducted on order confirmation
Export to PDF

Dashboard
Daily and Weekly sales graphs (Chart.js)

Total sales amount

Order count

Low stock alerts (stock < 5)

#Packages Used
Laravel Breeze (Bootstrap)
DomPDF
Chart.js
Font Awesome
Laravel Eloquent

# License
This project is open-sourced and available under the MIT license.

# Author
Developed by Takhmeena Mushtaq

Feel free to reach out via LinkedIn or GitHub if you want to collaborate or contribute!
