<?php

namespace Database\Seeders;

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
                'name' => 'Margherita',
                'pizza' => 'Margherita' . ' ' . 'Small',
                'price' => 30.00,
                'type' => 'Pizza',
                'size' => 'Small',
                'category' => 'Clássica',
            ],
            [
                'name' => 'Margherita',
                'pizza' => 'Margherita' . ' ' . 'Medium',
                'price' => 40.00,
                'type' => 'Pizza',
                'size' => 'Medium',
                'category' => 'Clássica',
            ],
            [
                'name' => 'Margherita',
                'pizza' => 'Margherita' . ' ' . 'Big',
                'price' => 50.00,
                'type' => 'Pizza',
                'size' => 'Big',
                'category' => 'Clássica',
            ],
        ];

        DB::table('products')->insert($data);
    }
}
