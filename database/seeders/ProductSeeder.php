<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Web Development Guide 2023',
                'slug' => 'web-development-guide-2023',
                'description' => 'Comprehensive guide to modern web development techniques including HTML5, CSS3, JavaScript, and popular frameworks.',
                'category' => 'e-book',
                'price_user' => 29.99,
                'price_developer' => 49.99,
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 48,
                'demo_link' => 'https://example.com/demo/web-guide',
            ],
            [
                'name' => 'Modern Dashboard UI Kit',
                'slug' => 'modern-dashboard-ui-kit',
                'description' => 'Figma template for creating beautiful admin dashboards with 100+ components and 50+ screens.',
                'category' => 'template',
                'price_user' => 49.99,
                'price_developer' => 99.99,
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 32,
                'demo_link' => 'https://example.com/demo/dashboard-ui',
            ],
            [
                'name' => 'Inventory Management System',
                'slug' => 'inventory-management-system',
                'description' => 'Complete solution for tracking and managing inventory with features like barcode scanning, reports, and multi-user access.',
                'category' => 'application',
                'price_user' => 199.99,
                'price_developer' => 499.99,
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 56,
                'demo_link' => 'https://example.com/demo/inventory',
            ],
            [
                'name' => 'E-commerce Starter Kit',
                'slug' => 'e-commerce-starter-kit',
                'description' => 'Ready-to-use e-commerce solution with product management, cart, checkout, and payment integration.',
                'category' => 'application',
                'price_user' => 149.99,
                'price_developer' => 349.99,
                'featured' => false,
                'rating' => 5,
                'reviews_count' => 41,
                'demo_link' => 'https://example.com/demo/ecommerce',
            ],
            [
                'name' => 'Mobile App Design System',
                'slug' => 'mobile-app-design-system',
                'description' => 'Complete design system for iOS and Android apps with 200+ components and 20+ screen templates.',
                'category' => 'template',
                'price_user' => 39.99,
                'price_developer' => 89.99,
                'featured' => false,
                'rating' => 5,
                'reviews_count' => 28,
                'demo_link' => 'https://example.com/demo/mobile-design',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                'category' => $product['category'],
                'price_user' => $product['price_user'],
                'price_developer' => $product['price_developer'],
                'featured' => $product['featured'],
                'rating' => $product['rating'],
                'reviews_count' => $product['reviews_count'],
                'demo_link' => $product['demo_link'],
                'image' => 'products/placeholder-' . $product['category'] . '.jpg',
            ]);
        }
    }
}
