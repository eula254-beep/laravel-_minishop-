# Laravel MiniShop - Setup Commands

This file contains all the Artisan commands needed to generate the project files.

## Initial Setup Commands

```bash
# Create a new Laravel project (if starting from scratch)
composer create-project laravel/laravel minishop
cd minishop

# Install Laravel Breeze for authentication
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

## Database & Models

```bash
# Create Product model with migration
php artisan make:model Product -m

# Create additional migration to add role column to users table
php artisan make:migration add_role_to_users_table --table=users

# Create seeders
php artisan make:seeder UserSeeder
php artisan make:seeder ProductSeeder
```

## Controllers

```bash
# Create Admin Product Controller (Resource Controller)
php artisan make:controller Admin/ProductController --resource

# Create Shop Controller
php artisan make:controller Shop/ShopController
```

## Middleware

```bash
# Create IsAdmin middleware
php artisan make:middleware IsAdmin
```

## Run Migrations and Seeders

```bash
# Copy .env.example to .env and configure database
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Or run migration with seed in one command
php artisan migrate:fresh --seed
```

## Development Server

```bash
# Serve the application
php artisan serve

# In another terminal, run Vite dev server (if using Breeze)
npm run dev
```

## Storage Link (for product images)

```bash
# Create symbolic link for storage
php artisan storage:link
```

## Testing Credentials

**Admin Account:**
- Email: admin@minishop.com
- Password: password

**Customer Account:**
- Email: client@minishop.com
- Password: password
