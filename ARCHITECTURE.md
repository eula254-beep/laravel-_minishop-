# MiniShop Architecture Documentation

## 📐 Architecture Overview

This document explains the architectural decisions and design patterns used in the MiniShop application.

---

## 🏗️ MVC Pattern Implementation

### Why MVC?
- **Separation of Concerns**: Each layer has a distinct responsibility
- **Maintainability**: Easy to update one layer without affecting others
- **Testability**: Components can be tested independently
- **Scalability**: Easy to add new features

### Layer Breakdown

#### Models (`app/Models/`)
**Purpose**: Represent data structure and business logic

**User.php**
- Extends Laravel's Authenticatable class
- Contains helper methods: `isAdmin()`, `isCustomer()`
- Manages role-based logic
- Why: Encapsulates user-specific behavior

**Product.php**
- Represents product entity
- Includes `available()` scope for filtering
- Has `getFormattedPriceAttribute()` accessor
- Why: Handles product-specific data transformations

#### Views (`resources/views/`)
**Purpose**: Presentation layer - what users see

**Layout Structure**:
```
layouts/app.blade.php (Master)
├── admin/
│   ├── dashboard.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── shop/
    ├── index.blade.php
    └── show.blade.php
```

**Why Separate Admin/Shop Views?**
- Different user interfaces for different roles
- Admin needs forms and tables
- Shop needs product cards and details
- Keeps views focused and maintainable

#### Controllers (`app/Http/Controllers/`)
**Purpose**: Handle HTTP requests and coordinate between Models and Views

**Admin/ProductController.php**
- Resource controller (7 RESTful methods)
- Handles CRUD operations
- Manages file uploads
- Validates input
- Why: Centralized admin logic

**Shop/ShopController.php**
- Simple display controller
- Only `index()` and `show()` methods
- Read-only operations
- Why: Separation between admin and customer logic

---

## 🛣️ Routing Strategy

### Route Grouping Philosophy

```php
// 1. Public routes - No middleware
Route::get('/', [ShopController::class, 'index']);

// 2. Auth routes - Requires login
Route::middleware('auth')->group(function () {
    // Profile routes
});

// 3. Admin routes - Requires login + admin role
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('products', AdminProductController::class);
    });
```

### Why This Structure?

1. **Public First**: Homepage accessible to everyone
2. **Progressive Security**: Add middleware as needed
3. **URL Organization**: `/admin/*` clearly indicates protected area
4. **Route Naming**: `admin.products.index` creates clear route references

### Resource Routes Explained

`Route::resource('products', AdminProductController::class)` generates:

| Verb      | URI                    | Action  | Route Name            |
|-----------|------------------------|---------|-----------------------|
| GET       | /admin/products        | index   | admin.products.index  |
| GET       | /admin/products/create | create  | admin.products.create |
| POST      | /admin/products        | store   | admin.products.store  |
| GET       | /admin/products/{id}   | show    | admin.products.show   |
| GET       | /admin/products/{id}/edit | edit | admin.products.edit   |
| PUT/PATCH | /admin/products/{id}   | update  | admin.products.update |
| DELETE    | /admin/products/{id}   | destroy | admin.products.destroy|

**Why Resource Routes?**
- RESTful convention
- Less code, more clarity
- Standardized naming
- Laravel best practice

---

## 🔐 Security Architecture

### Middleware Stack

#### 1. Authentication (`auth`)
- Verifies user is logged in
- Redirects to login if not
- Laravel's built-in middleware

#### 2. IsAdmin (Custom)
```php
if (!auth()->check() || !auth()->user()->isAdmin()) {
    return redirect()->route('shop.index')->with('error', 'Access denied');
}
```

**Why Custom Middleware?**
- Laravel doesn't include role-based auth
- Reusable across multiple routes
- Clean separation of authorization logic
- Easy to extend for more roles

### Middleware Registration

In `app/Http/Kernel.php`:
```php
protected $middlewareAliases = [
    'isAdmin' => \App\Http\Middleware\IsAdmin::class,
];
```

**Why Register?**
- Use short alias (`isAdmin`) instead of full class name
- Centralized middleware management
- Easy to swap implementations

---

## 💾 Database Design

### Migration Strategy

**Why Two Migrations?**

1. `add_role_to_users_table.php`
   - Modifies existing users table
   - Laravel Breeze creates base users table
   - We extend it with `role` column
   - Non-destructive approach

2. `create_products_table.php`
   - New table for products
   - Independent of users
   - Follows single responsibility

### Seeding Strategy

**Why Separate Seeders?**

```
DatabaseSeeder.php (Orchestrator)
├── UserSeeder.php (2 users)
└── ProductSeeder.php (10 products)
```

**Benefits**:
- Run individually during development
- Easy to update data without affecting others
- Clear data ownership
- Testable in isolation

---

## 🎨 Frontend Architecture

### Tailwind CSS via CDN

**Why CDN Instead of Build Process?**
- ✅ Zero build configuration
- ✅ Faster development
- ✅ No node_modules bloat
- ✅ Perfect for test projects
- ❌ Larger file size (production consideration)

### Alpine.js for Interactivity

**Why Alpine.js?**
- Lightweight (15kb)
- Blade-friendly syntax
- No build step required
- Perfect for dropdowns, modals, toggles
- Avoids React/Vue complexity

### Blade Components Strategy

**Master Layout Pattern**:
```blade
@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    <!-- Page content -->
@endsection
```

**Why?**
- DRY: Navigation/footer in one place
- Consistent UI across all pages
- Easy to update global elements
- Laravel convention

---

## 📦 File Upload Handling

### Storage Strategy

```php
// Store in: storage/app/public/products/
$imagePath = $request->file('image')->store('products', 'public');

// Save path in DB: products/filename.jpg
$product->image_path = $imagePath;
```

### Why This Approach?

1. **Public Disk**: Images need to be web-accessible
2. **Organized Folder**: All product images in one place
3. **Relative Paths**: Database stores path, not full URL
4. **Symbolic Link**: `php artisan storage:link` makes storage/app/public accessible at public/storage

### Display Images

```blade
<img src="{{ asset('storage/' . $product->image_path) }}" />
```

**Flow**:
```
Upload → storage/app/public/products/image.jpg
         ↓
DB stores: products/image.jpg
         ↓
Display: public/storage/products/image.jpg (via symlink)
         ↓
URL: /storage/products/image.jpg
```

---

## 🧩 Design Patterns Used

### 1. Repository Pattern (Implicit)
- Models act as repositories
- `Product::available()` scope
- Clean data access layer

### 2. Dependency Injection
- Controllers receive Request objects
- Laravel automatically resolves dependencies
- `public function update(Request $request, Product $product)`

### 3. Route Model Binding
```php
// Instead of: Product::findOrFail($id)
// Laravel does: Route::get('/products/{product}', ...)
// Auto-injects: function show(Product $product)
```

### 4. Form Request Validation
- Controller validates inline
- Could be extracted to Form Requests for complex apps
- Keeps validation close to action

---

## 🔄 Data Flow

### Customer Viewing Product

```
User → Route (/) → ShopController@index
                    ↓
                Product::available()->latest()->paginate()
                    ↓
                Return view('shop.index', compact('products'))
                    ↓
                Blade renders product grid
                    ↓
                HTML sent to browser
```

### Admin Creating Product

```
User → Route (/admin/products/create) → ProductController@create
                                          ↓
                                    Return create form
                                          ↓
User fills form → POST /admin/products → ProductController@store
                                          ↓
                                    Validate input
                                          ↓
                                    Upload image
                                          ↓
                                    Product::create()
                                          ↓
                                    Redirect with success message
```

---

## 🎯 Design Decisions Summary

### Why Laravel Breeze?
- Minimal authentication scaffolding
- Blade templates (no Vue/React complexity)
- Profile management included
- Perfect for learning projects

### Why No API?
- This is a traditional web app
- Server-side rendering (Blade)
- No need for SPA complexity
- Easier to understand for beginners

### Why Pagination?
- `paginate(12)` in queries
- Automatic "Next/Previous" links
- Better performance with many products
- Laravel best practice

### Why Scopes in Models?
```php
// Instead of:
Product::where('available', true)->get();

// We use:
Product::available()->get();
```
- More readable
- Reusable logic
- Follows Eloquent conventions

---

## 📚 Learning Path

### For Video Walkthrough

**Key Points to Explain**:

1. **MVC Separation**
   - "We keep business logic in Models, request handling in Controllers, and presentation in Views"

2. **Route Organization**
   - "Public routes for customers, auth middleware for logged-in users, and isAdmin for admins"

3. **Resource Controllers**
   - "Laravel's resource routes give us 7 RESTful methods automatically"

4. **Middleware Security**
   - "Our custom IsAdmin middleware protects admin routes from regular users"

5. **Blade Templating**
   - "Master layout pattern keeps our navigation and footer consistent"

6. **Database Seeding**
   - "Seeders let us quickly populate test data for development"

---

## 🚀 Extending the Application

### Adding a New Feature (Example: Categories)

1. **Database**: Create migration and model
2. **Relationship**: Add `category_id` to products
3. **Controller**: Add category filtering in ShopController
4. **Routes**: Add category browsing route
5. **Views**: Add category filter dropdown

This architecture makes extensions straightforward!

---

**This architecture prioritizes clarity, security, and Laravel best practices over complexity.**