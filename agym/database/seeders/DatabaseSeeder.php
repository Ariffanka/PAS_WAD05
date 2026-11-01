<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@agym.test'],
            [
                'name' => 'A-Gym Admin',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@agym.test'],
            [
                'name' => 'A-Gym Staff',
                'password' => Hash::make('Staff123!'),
                'role' => 'staff',
            ]
        );

        $categories = [
            ['name' => 'Strength Equipment', 'description' => 'Weight training equipment.'],
            ['name' => 'Cardio Equipment', 'description' => 'Cardiovascular training equipment.'],
            ['name' => 'Accessories', 'description' => 'Gym accessories and small equipment.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }

        $supplier = Supplier::firstOrCreate(
            ['name' => 'A-Gym Equipment Supply'],
            [
                'email' => 'supplier@agym.test',
                'phone' => '081234567890',
                'address' => 'Jakarta, Indonesia',
            ]
        );

        $products = [
            [
                'name' => 'Dumbbell 10 KG',
                'sku' => 'AGY-DB-010',
                'category_id' => Category::where('name', 'Strength Equipment')->first()->id,
                'price' => 350000,
                'stock' => 20,
                'minimum_stock' => 5,
            ],
            [
                'name' => 'Treadmill',
                'sku' => 'AGY-TM-001',
                'category_id' => Category::where('name', 'Cardio Equipment')->first()->id,
                'price' => 7500000,
                'stock' => 4,
                'minimum_stock' => 2,
            ],
            [
                'name' => 'Resistance Band',
                'sku' => 'AGY-RB-001',
                'category_id' => Category::where('name', 'Accessories')->first()->id,
                'price' => 75000,
                'stock' => 30,
                'minimum_stock' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                array_merge($product, ['supplier_id' => $supplier->id])
            );
        }
    }
}