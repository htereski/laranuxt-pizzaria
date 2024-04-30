<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindSeeder extends Seeder
{
    
    public function run(): void
    {
        $data = [
            [
                'name' => 'Clássica',
                'multiplier' => 1
            ],
            [
                'name' => 'Vegetariana',
                'multiplier' => 1
            ],
            [
                'name' => 'Gourmet',
                'multiplier' => 1.5
            ],
            [
                'name' => 'Especial',
                'multiplier' => 1.1
            ],
            [
                'name' => 'Doce',
                'multiplier' => 1.3
            ]
        ];

        DB::table('kinds')->insert($data);
    }
}
