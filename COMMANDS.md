# Quick Reference - Laravel Artisan Commands

## 🎯 Essential Commands for MiniShop

### Initial Setup (One-Time)
```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate:fresh --seed
php artisan storage:link

# Build assets
npm run build
```

### Development Workflow
```bash
# Start development server
php artisan serve

# Watch for frontend changes (separate terminal)
npm run dev

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Commands
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset database and run all migrations with seeders
php artisan migrate:fresh --seed

# Run seeders only
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=ProductSeeder
```

### Creating New Files
```bash
# Create model with migration
php artisan make:model Product -m

# Create controller (resource)
php artisan make:controller Admin/ProductController --resource

# Create middleware
php artisan make:middleware IsAdmin

# Create seeder
php artisan make:seeder ProductSeeder

# Create migration
php artisan make:migration add_role_to_users_table --table=users
```

### Viewing Routes
```bash
# List all routes
php artisan route:list

# Filter routes by name
php artisan route:list --name=admin

# Filter routes by URI
php artisan route:list --path=products
```

### Laravel Tinker (Database Testing)
```bash
# Open interactive shell
php artisan tinker

# Inside tinker:
>>> User::all()
>>> Product::where('available', true)->get()
>>> User::find(1)->isAdmin()
>>> exit
```

### Storage Management
```bash
# Create symbolic link (for images)
php artisan storage:link

# Recreate link if broken
rm public/storage
php artisan storage:link
```

### Code Quality
```bash
# Generate IDE helper (optional, for autocomplete)
composer require --dev barryvdh/laravel-ide-helper
php artisan ide-helper:generate

# Dump autoload (if classes not found)
composer dump-autoload
```

### Testing Login Credentials
```bash
# Admin
Email: admin@minishop.com
Password: password

# Customer
Email: client@minishop.com
Password: password
```

### Common Troubleshooting
```bash
# Fix permission issues (Linux/Mac)
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache

# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan optimize
```

### Git Workflow
```bash
# Initialize git (if needed)
git init
git add .
git commit -m "Initial commit: MiniShop Laravel application"

# Push to GitHub
git remote add origin <repository-url>
git branch -M main
git push -u origin main
```

### Production Deployment Checklist
```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Generate assets for production
npm run build
```

---

## 🔍 Debugging Commands

```bash
# View logs
tail -f storage/logs/laravel.log

# Check database connection
php artisan db:show

# List database tables
php artisan db:table users

# Check environment variables
php artisan env

# Test email configuration
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('test@example.com')->subject('Test'); });
```

---

## 📊 Useful SQL Queries (via Tinker)

```bash
php artisan tinker

# Count products
>>> Product::count()

# Get available products
>>> Product::available()->count()

# Find admin users
>>> User::where('role', 'admin')->get()

# Get products with price > 100
>>> Product::where('price', '>', 100)->get()

# Create a new product manually
>>> Product::create(['name' => 'Test', 'price' => 99.99, 'description' => 'Test', 'available' => true])
```

---

**Pro Tip**: Add these to your shell aliases for faster development!

```bash
# Add to ~/.bashrc or ~/.zshrc
alias art="php artisan"
alias mfs="php artisan migrate:fresh --seed"
alias serve="php artisan serve"
alias tinker="php artisan tinker"
```

Then use: `art migrate`, `mfs`, `serve`, etc.