# MiniShop - Laravel E-Commerce Application

![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

A clean and professional e-commerce application built with Laravel, demonstrating best practices in MVC architecture, authentication, and role-based access control.

---

## 📋 Project Overview

**MiniShop** is a test e-commerce application showcasing:
- **MVC Architecture**: Strict separation of concerns
- **Role-Based Access Control**: Admin and Customer roles
- **Product Management**: Full CRUD operations for administrators
- **Public Shop**: Customer-facing product catalog
- **Responsive Design**: Mobile-first UI with Tailwind CSS
- **Clean Code**: Well-commented, maintainable codebase

---

## 🚀 Features

### Customer Features
- Browse available products in a responsive grid layout
- View detailed product information
- See product availability status
- Responsive design for mobile and desktop

### Admin Features
- Complete product management dashboard
- Create, edit, and delete products
- Upload product images
- Toggle product availability
- Protected routes with middleware

---

## 🛠️ Tech Stack

- **Framework**: Laravel 10/11
- **Language**: PHP 8.2+
- **Database**: MySQL (or SQLite for simplicity)
- **Frontend**: Blade Templates + Tailwind CSS (CDN)
- **Authentication**: Laravel Breeze
- **JavaScript**: Alpine.js (for minimal interactivity)

---

## 📦 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL or SQLite
- Node.js & NPM (for Laravel Breeze assets)

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd minishop
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies (for Breeze)
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup
Edit your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minishop
DB_USERNAME=root
DB_PASSWORD=your_password
```

**Or use SQLite** (simpler for testing):
```env
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

If using SQLite, create the database file:
```bash
touch database/database.sqlite
```

### Step 5: Run Migrations & Seeders
```bash
# Run migrations and seed the database
php artisan migrate:fresh --seed
```

This will create:
- 1 Admin user
- 1 Customer user
- 10 sample products

### Step 6: Create Storage Link
```bash
# Create symbolic link for product images
php artisan storage:link
```

### Step 7: Build Assets
```bash
# Compile frontend assets (Breeze)
npm run build

# Or run in development mode with hot reload
npm run dev
```

### Step 8: Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🔐 Login Credentials

### Admin Account
- **Email**: `admin@minishop.com`
- **Password**: `password`
- **Access**: Full product management dashboard at `/admin/products`

### Customer Account
- **Email**: `client@minishop.com`
- **Password**: `password`
- **Access**: Public shop view only

---

## 📁 Project Structure

```
minishop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── ProductController.php    # Admin CRUD operations
│   │   │   └── Shop/
│   │   │       └── ShopController.php       # Public shop views
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php                  # Role-based access middleware
│   │   └── Kernel.php                       # Middleware registration
│   └── Models/
│       ├── User.php                         # User model with role methods
│       └── Product.php                      # Product model with scopes
├── database/
│   ├── migrations/
│   │   ├── xxxx_add_role_to_users_table.php
│   │   └── xxxx_create_products_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php               # Main seeder orchestrator
│       ├── UserSeeder.php                   # Seeds admin & customer users
│       └── ProductSeeder.php                # Seeds 10 sample products
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                # Master layout with Tailwind CSS
│       ├── admin/
│       │   ├── dashboard.blade.php          # Product management table
│       │   ├── create.blade.php             # Create product form
│       │   └── edit.blade.php               # Edit product form
│       └── shop/
│           ├── index.blade.php              # Product grid (public)
│           └── show.blade.php               # Product details (public)
└── routes/
    └── web.php                              # Application routes
```

---

## 🗺️ Routes & Architecture

### Route Organization Explained

The application uses **three distinct route groups** to maintain clean separation:

#### 1. Public Routes (Shop)
```php
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('shop.show');
```
- **Purpose**: Accessible to all visitors (guests and authenticated users)
- **Controller**: `Shop/ShopController` handles public-facing product views
- **Why**: Separates customer-facing logic from admin operations

#### 2. Authenticated User Routes
```php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']);
    // ... more profile routes
});
```
- **Purpose**: Profile management (from Laravel Breeze)
- **Middleware**: `auth` ensures user is logged in
- **Why**: Standard user account management

#### 3. Admin Routes
```php
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::resource('products', AdminProductController::class);
    });
```
- **Purpose**: Product management CRUD operations
- **Prefix**: All routes start with `/admin` for clear URL structure
- **Middleware**: 
  - `auth`: Ensures user is logged in
  - `isAdmin`: Custom middleware checks if user has admin role
- **Resource Route**: Automatically generates 7 RESTful routes (index, create, store, show, edit, update, destroy)
- **Why**: Provides secure, organized admin panel with minimal code

### Controller Architecture

#### Admin/ProductController
- **Responsibility**: Handle all admin product CRUD operations
- **Methods**: 
  - `index()`: List all products
  - `create()`: Show create form
  - `store()`: Save new product
  - `edit()`: Show edit form
  - `update()`: Update existing product
  - `destroy()`: Delete product
- **Why Separate**: Admin logic includes validation, file uploads, and database operations

#### Shop/ShopController
- **Responsibility**: Display products to customers
- **Methods**:
  - `index()`: Show product grid (only available products)
  - `show()`: Show single product details
- **Why Separate**: Customer views are read-only and focus on presentation

---

## 🧪 Database Schema

### Users Table
| Column             | Type      | Notes                          |
|--------------------|-----------|--------------------------------|
| id                 | bigint    | Primary key                    |
| name               | varchar   | User's full name               |
| email              | varchar   | Unique email                   |
| **role**           | varchar   | 'admin' or 'customer'          |
| password           | varchar   | Hashed password                |
| email_verified_at  | timestamp | Nullable                       |
| remember_token     | varchar   | For "remember me" functionality|
| created_at         | timestamp |                                |
| updated_at         | timestamp |                                |

### Products Table
| Column       | Type       | Notes                          |
|--------------|------------|--------------------------------|
| id           | bigint     | Primary key                    |
| name         | varchar    | Product name                   |
| price        | decimal    | Product price (10,2)           |
| description  | text       | Detailed description           |
| image_path   | varchar    | Path to product image          |
| available    | boolean    | Availability status            |
| created_at   | timestamp  |                                |
| updated_at   | timestamp  |                                |

---

## 🎨 UI/UX Features

- **Responsive Grid Layout**: Product cards adapt to screen size (1-4 columns)
- **Tailwind CSS**: Utility-first CSS framework via CDN (no build step required)
- **Alpine.js**: Lightweight JavaScript for dropdown menus and mobile navigation
- **Flash Messages**: Success/error notifications with auto-dismiss
- **Image Handling**: Graceful fallback for products without images
- **Loading States**: Clear visual feedback for all actions

---

## 🔒 Security Features

- **Role-Based Access Control (RBAC)**: Custom `IsAdmin` middleware
- **CSRF Protection**: Laravel's built-in CSRF tokens on all forms
- **Password Hashing**: Bcrypt hashing for user passwords
- **File Upload Validation**: Type and size restrictions on images
- **Route Protection**: Middleware ensures unauthorized access is prevented

---

## 📝 Code Quality

- **PSR Standards**: Follows PHP coding standards
- **Comments**: Comprehensive inline documentation
- **DRY Principle**: Reusable components and layouts
- **Validation**: Server-side validation on all form submissions
- **Error Handling**: Graceful error messages for users

---

## 🎓 Learning Objectives

This project demonstrates:

1. **MVC Separation**: Clear distinction between Models, Views, and Controllers
2. **Laravel Best Practices**: Resource controllers, route grouping, middleware
3. **Authentication**: Laravel Breeze integration
4. **Database Design**: Migrations, seeders, and relationships
5. **Frontend Integration**: Blade templates with modern CSS
6. **File Uploads**: Handling and storing product images
7. **Security**: Middleware, validation, and authorization

---

## 🚧 Future Enhancements

Potential additions for extended learning:
- Shopping cart functionality
- Order management system
- Payment gateway integration (Stripe/PayPal)
- Product categories and filtering
- Customer reviews and ratings
- Search functionality
- Email notifications
- API endpoints for mobile app

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

Built with ❤️ using Laravel best practices for educational purposes.

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: "Class 'IsAdmin' not found"
```bash
composer dump-autoload
```

**Issue**: Images not displaying
```bash
php artisan storage:link
```

**Issue**: 404 on routes
```bash
php artisan route:cache
php artisan route:clear
```

**Issue**: Migration errors
```bash
php artisan migrate:fresh --seed
```

---

## 📞 Support

For questions or issues, please open an issue in the repository.

---

**Happy Coding! 🚀**
