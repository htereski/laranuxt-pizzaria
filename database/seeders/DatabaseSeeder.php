<?php

namespace Database\Seeders;

use App\Models\PizzaOrder;
use App\Models\User;
use Database\Factories\PizzaOrderFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call(
            [
                RoleSeeder::class,
                SizeSeeder::class,
                KindSeeder::class,
                PizzaSeeder::class
            ]
        );

        User::factory(10)->create();
        PizzaOrder::factory(20)->create();
    }
}
