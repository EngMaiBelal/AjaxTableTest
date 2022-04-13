<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'AA Company',
            ],
            [
                'name' => 'BB Company',
            ],
            [
                'name' => 'CC Company',
            ],
            [
                'name' => 'DD Company',
            ]
        ];

        foreach ($suppliers as $key => $value) {
            Supplier::create($value);
        }
    }
}
