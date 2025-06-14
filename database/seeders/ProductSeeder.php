<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Example seeded products
         $products = [
            ['name' => 'Laptop', 'sku' => 'LAP123', 'price' => 74999.99, 'quantity' => 10],
            ['name' => 'Mouse', 'sku' => 'MOU456', 'price' => 499.00, 'quantity' => 150],
            ['name' => 'Keyboard', 'sku' => 'KEY789', 'price' => 799.00, 'quantity' => 120],
            ['name' => 'Monitor', 'sku' => 'MON321', 'price' => 12499.50, 'quantity' => 30],
            ['name' => 'Printer', 'sku' => 'PRI654', 'price' => 8999.00, 'quantity' => 25],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
