<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'name' => 'Pequena',
                'value' => 30.00
            ],
            [
                'name' => 'Média',
                'value' => 40.00
            ],
            [
                'name' => 'Grande',
                'value' => 50.00
            ]
        ];

        DB::table('sizes')->insert($data);
    }
}
