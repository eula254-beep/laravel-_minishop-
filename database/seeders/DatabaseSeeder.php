<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * This is the main seeder that orchestrates all other seeders.
     * Run with: php artisan db:seed
     */
    public function run(): void
    {
        // Call individual seeders in the correct order
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
