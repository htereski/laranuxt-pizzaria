<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'name' => 'Margherita',
                'kind_id' => 1,
            ],
            [
                'name' => 'Pepperoni',
                'kind_id' => 1,
            ],
            [
                'name' => 'Quatro Queijos',
                'kind_id' => 1,
            ],
            [
                'name' => 'Vegetariana',
                'kind_id' => 2,
            ],
            [
                'name' => 'Mediterrânea',
                'kind_id' => 2,
            ],
            [
                'name' => 'Primavera',
                'kind_id' => 2,
            ],
            [
                'name' => 'Frango com Catupiry',
                'kind_id' => 3,
            ],
            [
                'name' => 'Prosciutto com Rúcula',
                'kind_id' => 3,
            ],
            [
                'name' => 'Funghi Trufado',
                'kind_id' => 3,
            ],
            [
                'name' => 'Portuguesa',
                'kind_id' => 4,
            ],
            [
                'name' => 'Calabresa',
                'kind_id' => 4,
            ],
            [
                'name' => 'Churrasco',
                'kind_id' => 4,
            ],
            [
                'name' => 'Chocolate',
                'kind_id' => 5,
            ],
            [
                'name' => 'Banana Caramelada',
                'kind_id' => 5,
            ],
            [
                'name' => 'Romeu e Julieta',
                'kind_id' => 5,
            ]
        ];

        DB::table('pizzas')->insert($data);
    }
}
