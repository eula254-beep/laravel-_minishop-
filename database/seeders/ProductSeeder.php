<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds 10 realistic products for the MiniShop.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'price' => 79.99,
                'description' => 'Premium wireless headphones with active noise cancellation, 30-hour battery life, and superior sound quality. Perfect for music lovers and professionals.',
                'image_path' => 'products/headphones.jpg',
                'available' => true,
            ],
            [
                'name' => 'Smart Fitness Watch',
                'price' => 199.99,
                'description' => 'Track your fitness goals with this advanced smartwatch featuring heart rate monitoring, GPS, sleep tracking, and 50+ sport modes.',
                'image_path' => 'products/fitness-watch.jpg',
                'available' => true,
            ],
            [
                'name' => 'Portable Power Bank 20000mAh',
                'price' => 45.99,
                'description' => 'High-capacity power bank with fast charging technology. Charge multiple devices simultaneously with dual USB ports and USB-C output.',
                'image_path' => 'products/power-bank.jpg',
                'available' => true,
            ],
            [
                'name' => 'Mechanical Gaming Keyboard',
                'price' => 129.99,
                'description' => 'RGB backlit mechanical keyboard with customizable keys, anti-ghosting technology, and premium build quality for professional gamers.',
                'image_path' => 'products/keyboard.jpg',
                'available' => true,
            ],
            [
                'name' => '4K Webcam with Ring Light',
                'price' => 89.99,
                'description' => 'Professional 4K webcam with built-in ring light, auto-focus, and noise-canceling microphone. Ideal for streaming and video conferences.',
                'image_path' => 'products/webcam.jpg',
                'available' => true,
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'price' => 299.99,
                'description' => 'Adjustable ergonomic chair with lumbar support, breathable mesh back, and 360-degree swivel. Designed for all-day comfort.',
                'image_path' => 'products/office-chair.jpg',
                'available' => false, // Out of stock example
            ],
            [
                'name' => 'USB-C Docking Station',
                'price' => 149.99,
                'description' => '11-in-1 USB-C hub with dual HDMI, Ethernet, SD card reader, and multiple USB ports. Transform your laptop into a workstation.',
                'image_path' => 'products/docking-station.jpg',
                'available' => true,
            ],
            [
                'name' => 'Wireless Gaming Mouse',
                'price' => 69.99,
                'description' => 'Lightweight wireless gaming mouse with 16000 DPI sensor, programmable buttons, and 70-hour battery life.',
                'image_path' => 'products/gaming-mouse.jpg',
                'available' => true,
            ],
            [
                'name' => 'Laptop Stand with Cooling',
                'price' => 39.99,
                'description' => 'Adjustable aluminum laptop stand with dual cooling fans. Improves posture and keeps your laptop cool during intensive tasks.',
                'image_path' => 'products/laptop-stand.jpg',
                'available' => true,
            ],
            [
                'name' => 'Blue Light Blocking Glasses',
                'price' => 24.99,
                'description' => 'Stylish glasses that filter harmful blue light from screens. Reduce eye strain and improve sleep quality.',
                'image_path' => 'products/glasses.jpg',
                'available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
