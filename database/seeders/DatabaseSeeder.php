<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@blizz.com',
            'password' => Hash::make('password123'),
        ]);

        // Create categories
        $categories = [
            ['name' => 'Anti-Aging', 'slug' => 'anti-aging', 'description' => 'Products to reduce signs of aging'],
            ['name' => 'Moisturizers', 'slug' => 'moisturizers', 'description' => 'Hydrating face creams'],
            ['name' => 'Night Creams', 'slug' => 'night-creams', 'description' => 'Overnight skin repair'],
            ['name' => 'Day Creams', 'slug' => 'day-creams', 'description' => 'Daily protection and hydration'],
            ['name' => 'Sensitive Skin', 'slug' => 'sensitive-skin', 'description' => 'Gentle formulas for sensitive skin'],
            ['name' => 'Acne Care', 'slug' => 'acne-care', 'description' => 'Products for acne-prone skin'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample products
        $products = [
            [
                'name' => 'Radiance Renewal Cream',
                'slug' => 'radiance-renewal-cream',
                'description' => 'A luxurious anti-aging cream that helps reduce fine lines and wrinkles while boosting skin radiance.',
                'price' => 89.99,
                'discount_percentage' => 15,
                'discounted_price' => 76.49,
                'quantity' => 25,
                'category_id' => 1,
                'main_category' => 'Premium',
                'images' => [],
            ],
            [
                'name' => 'Hydra Boost Moisturizer',
                'slug' => 'hydra-boost-moisturizer',
                'description' => 'Deep hydrating moisturizer with hyaluronic acid for all-day moisture.',
                'price' => 45.99,
                'quantity' => 50,
                'category_id' => 2,
                'main_category' => 'Daily Care',
                'images' => [],
            ],
            [
                'name' => 'Midnight Recovery Night Cream',
                'slug' => 'midnight-recovery-night-cream',
                'description' => 'Intensive overnight treatment that repairs and rejuvenates skin while you sleep.',
                'price' => 65.99,
                'discount_percentage' => 20,
                'discounted_price' => 52.79,
                'quantity' => 30,
                'category_id' => 3,
                'main_category' => 'Premium',
                'images' => [],
            ],
            [
                'name' => 'Daily Defense SPF Cream',
                'slug' => 'daily-defense-spf-cream',
                'description' => 'Protective day cream with SPF 30 and antioxidants for daily use.',
                'price' => 39.99,
                'quantity' => 40,
                'category_id' => 4,
                'main_category' => 'Daily Care',
                'images' => [],
            ],
            [
                'name' => 'Gentle Care Sensitive Cream',
                'slug' => 'gentle-care-sensitive-cream',
                'description' => 'Fragrance-free, hypoallergenic cream designed for sensitive skin types.',
                'price' => 42.99,
                'quantity' => 20,
                'category_id' => 5,
                'main_category' => 'Sensitive',
                'images' => [],
            ],
            [
                'name' => 'Clear Skin Acne Treatment',
                'slug' => 'clear-skin-acne-treatment',
                'description' => 'Targeted treatment cream with salicylic acid for acne-prone skin.',
                'price' => 35.99,
                'quantity' => 0,
                'allow_preorder' => true,
                'category_id' => 6,
                'main_category' => 'Treatment',
                'images' => [],
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create sample testimonials
        $testimonials = [
            [
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah@example.com',
                'message' => 'Amazing results! My skin has never looked better. The Radiance Renewal Cream is a game-changer.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Emily Davis',
                'customer_email' => 'emily@example.com',
                'message' => 'I love the Hydra Boost Moisturizer. It keeps my skin hydrated all day without feeling greasy.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Michelle Brown',
                'customer_email' => 'michelle@example.com',
                'message' => 'The night cream works wonders! I wake up with softer, smoother skin every morning.',
                'rating' => 4,
                'is_approved' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
