# Blizz Face Cream E-commerce Application

A complete Laravel-based e-commerce web application for Blizz, a premium face cream brand store.

## Features

### Admin Panel
- **Dashboard**: Overview of products, orders, categories, and sales statistics
- **Product Management**: Full CRUD operations for products with image uploads
- **Order Management**: Track orders with status updates (pending → preparing → shipped → completed)
- **Stock Management**: Monitor inventory levels and low stock alerts
- **Pre-order Management**: Handle products available for pre-order
- **Testimonials Management**: Approve/disapprove customer reviews
- **Sales Summary**: Revenue tracking and analytics
- **Admin Authentication**: Secure login system for administrators

### Customer Frontend
- **Modern Homepage**: Hero slider, featured products, categories, testimonials
- **Product Catalog**: Advanced filtering by category, price range, and search
- **Product Details**: Comprehensive product information and related products
- **Shopping Cart**: Add to cart functionality with localStorage persistence
- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Contact Information**: Business contact details and location

## Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Alpine.js, AOS animations
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication with custom admin guard
- **File Storage**: Laravel's file storage system for product images

## Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Node.js & NPM
- WAMP/XAMPP (for local development)

### Database Setup
1. Create a MySQL database named `blizz`
2. Update database configuration in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blizz
DB_USERNAME=root
DB_PASSWORD=
```

### Installation Steps
1. Install PHP dependencies:
```bash
composer install
```

2. Install Node.js dependencies:
```bash
npm install
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Run database migrations:
```bash
php artisan migrate
```

5. Seed the database with sample data:
```bash
php artisan db:seed
```

6. Create storage symlink:
```bash
php artisan storage:link
```

7. Build frontend assets:
```bash
npm run dev
```

8. Start the development server:
```bash
php artisan serve
```

## Default Admin Credentials
- **Email**: admin@blizz.com
- **Password**: password123

## Sample Data

The application comes with pre-seeded data including:
- 6 product categories (Anti-Aging, Moisturizers, Night Creams, etc.)
- 6 sample products with different pricing and stock levels
- 3 approved customer testimonials
- 1 admin user account

## Image Placeholders

Sample images are referenced with numbered naming convention:
- Product images: `product_placeholder_1.jpg` to `product_placeholder_10.jpg`
- Category icons: `category_icon_1.jpg` to `category_icon_6.jpg`
- Customer avatars: `customer_avatar_1.jpg` to `customer_avatar_3.jpg`
- Hero image: `hero_image_1.jpg`

Place these images in the `public/images/` directory.

## Color Theme

The application uses a centralized color theme defined in `tailwind.config.js`:
- **Primary**: Purple gradient (#540a6e to #e557ff)
- **Secondary**: Blue gradient (#082f49 to #0ea5e9)

To change the color scheme, update the color values in the Tailwind configuration file.

## Key Routes

### Guest Routes
- `/` - Homepage
- `/products` - Product catalog with filters
- `/products/{product}` - Product detail page
- `/about` - About us page
- `/contact` - Contact information

### Admin Routes
- `/admin/login` - Admin login
- `/admin/dashboard` - Admin dashboard
- `/admin/products` - Product management
- `/admin/orders` - Order management
- `/admin/testimonials` - Testimonial management
- `/admin/sales-summary` - Sales analytics

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/           # Admin panel controllers
│   ├── HomeController.php
│   └── ProductController.php
├── Models/              # Eloquent models
└── Http/Middleware/     # Custom middleware

resources/
├── views/
│   ├── admin/          # Admin panel views
│   ├── layouts/        # Layout templates
│   └── *.blade.php     # Guest pages
└── css/app.css         # Tailwind CSS

database/
├── migrations/         # Database schema
└── seeders/           # Sample data seeders
```

## License

This project is proprietary software developed for Blizz Face Cream brand.
