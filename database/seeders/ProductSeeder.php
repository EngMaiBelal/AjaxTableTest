<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Samsung Galaxy',
                'price' => 100,
                'quantity' => 20,
            ],
            [
                'name' => 'Apple iPhone 12',
                'price' => 1000,
                'quantity' => 50,
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'price' => 5000,
                'quantity' => 30,
            ],
            [
                'name' => 'LG V10 H800',
                'price' => 3000,
                'quantity' => 70,
            ]
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
// a nother method for insert data
// https://madhavendra-dutt.medium.com/how-to-seed-test-data-into-a-database-in-laravel-ec1b7defe552
