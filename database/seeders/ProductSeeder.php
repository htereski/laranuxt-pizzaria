<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Coca-Cola 2L',
                'price' => 12.00,
                'stock' => 20,
                'type' => 'Drink',
            ],
            [
                'name' => 'Coca-Cola 3L',
                'price' => 18.00,
                'stock' => 20,
                'type' => 'Drink',
            ],
            [
                'name' => 'Cine Framboesa 2L',
                'price' => 10.00,
                'stock' => 20,
                'type' => 'Drink',
            ],
        ];

        DB::table('products')->insert($data);
    }
}
