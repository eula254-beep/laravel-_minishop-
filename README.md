# MiniShop - Laravel E-Commerce Application

![Laravel](https://img.shields.io/badge/Laravel-10-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

A clean and professional e-commerce application built with Laravel

---

## 📋 Overview

**MiniShop** is a Laravel e-commerce application showcasing:
- **MVC Architecture**: Strict separation of concerns
- **Role-Based Access Control**: Admin and Customer roles
- **Product Management**: Full CRUD operations for administrators
- **Public Shop**: Customer-facing product catalog
- **Responsive Design**: Mobile-first UI with Tailwind CSS
- **Authentication**: User login and registration

---

## 🚀 Features

### Customer Features
- Browse products in a responsive grid layout
- View detailed product information
- User registration and login
- Responsive design for mobile and desktop

### Admin Features
- Complete product management dashboard
- Create, edit, and delete products
- Upload product images
- Toggle product availability
- Protected routes with middleware

---

## 🛠️ Tech Stack

- **Framework**: Laravel 10
- **Language**: PHP 8.1+
- **Database**: MySQL
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Alpine.js

---

## 📦 Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & NPM
- XAMPP (or similar local server)

### Step 1: Clone the Repository
```bash
git clone https://github.com/eula254-beep/laravel-_minishop-.git
cd laravel-_minishop-
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# The .env file should already exist, verify database settings
# Make sure these match your local MySQL setup:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minishop
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Start MySQL
- Open XAMPP Control Panel
- Start MySQL service
- Or run: `C:\xampp\mysql_start.bat`

### Step 5: Create Database
```bash
# Using MySQL CLI
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS minishop;"
```

### Step 6: Run Migrations & Seeders
```bash
# Run migrations and seed the database
php artisan migrate:fresh --seed
```

This creates:
- 1 Admin user
- 1 Customer user
- 10 sample products

### Step 7: Build Frontend Assets
```bash
# Build assets for production
npm run build

# Or run in development mode with hot reload
npm run dev
```

### Step 8: Start Development Server
```bash
# Start Laravel server
php artisan serve

# Visit: http://127.0.0.1:8000
```

---

## 🔐 Login Credentials

### Admin Account
- **Email**: `admin@minishop.com`
- **Password**: `password`
- **Access**: `/admin/products`

### Customer Account
- **Email**: `client@minishop.com`
- **Password**: `password`
- **Access**: Public shop only

---

## 📁 Project Structure

```
laravel-_minishop-/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/ProductController.php     # Admin CRUD
│   │   │   ├── Shop/ShopController.php         # Public shop
│   │   │   └── Auth/                           # Login/Register
│   │   └── Middleware/
│   │       └── IsAdmin.php                     # Admin access control
│   └── Models/
│       ├── User.php                            # User with roles
│       └── Product.php                         # Product model
├── database/
│   ├── migrations/                             # Database structure
│   └── seeders/                                # Sample data
├── resources/
│   └── views/
│       ├── layouts/app.blade.php               # Master layout
│       ├── admin/                              # Admin dashboard
│       ├── shop/                               # Public shop
│       └── auth/                               # Login/Register
└── routes/
    └── web.php                                 # Application routes
```

---

## 🗺️ Routes

### Public Routes
- `GET /` - Product listing
- `GET /products/{product}` - Product details
- `GET /login` - Login page
- `POST /login` - Login action
- `GET /register` - Registration page
- `POST /register` - Registration action
- `POST /logout` - Logout

### Admin Routes (Protected)
- `GET /admin/products` - Product dashboard
- `GET /admin/products/create` - Create form
- `POST /admin/products` - Store product
- `GET /admin/products/{id}/edit` - Edit form
- `PUT /admin/products/{id}` - Update product
- `DELETE /admin/products/{id}` - Delete product

---

## 🗄️ Database Schema

### Users Table
| Column       | Type      | Description                |
|--------------|-----------|----------------------------|
| id           | bigint    | Primary key                |
| name         | varchar   | User's name                |
| email        | varchar   | Unique email               |
| role         | varchar   | 'admin' or 'customer'      |
| password     | varchar   | Hashed password            |

### Products Table
| Column       | Type       | Description               |
|--------------|------------|---------------------------|
| id           | bigint     | Primary key               |
| name         | varchar    | Product name              |
| price        | decimal    | Product price             |
| description  | text       | Product description       |
| image_path   | varchar    | Path to product image     |
| available    | boolean    | Availability status       |

---

## 🔧 Common Commands

### Development
```bash
# Start server
php artisan serve

# Watch frontend changes
npm run dev

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Database
```bash
# Reset database
php artisan migrate:fresh --seed

# Run migrations only
php artisan migrate

# Run seeders only
php artisan db:seed
```

### Laravel Tinker
```bash
# Interactive shell
php artisan tinker

# Test queries
>>> User::all()
>>> Product::where('available', true)->get()
```

---

## 🏗️ Architecture Highlights

### MVC Pattern
- **Models**: Handle data and business logic
- **Views**: Blade templates for presentation
- **Controllers**: Process requests and coordinate

### Security Features
- CSRF protection on all forms
- Password hashing with bcrypt
- Role-based middleware (`isAdmin`)
- Input validation on all forms
- SQL injection protection (Eloquent ORM)

### Code Quality
- PSR-12 coding standards
- Comprehensive inline comments
- DRY principles
- Single Responsibility Principle
- RESTful routing conventions

---

## 🐛 Troubleshooting

### Session Store Error
```bash
php artisan config:clear
php artisan cache:clear
```

### Route Not Found
```bash
php artisan route:clear
php artisan route:list
```

### MySQL Connection Error
- Verify MySQL is running in XAMPP
- Check `.env` database credentials
- Ensure database exists

### Permission Errors (Linux/Mac)
```bash
sudo chmod -R 775 storage bootstrap/cache
```

---


## 🎯 Future Enhancements

- [ ] Shopping cart functionality
- [ ] Order management
- [ ] Payment integration
- [ ] Email notifications
- [ ] Product categories
- [ ] Search functionality
- [ ] Product reviews
- [ ] User profile management

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

Built by Eulah with love

---
