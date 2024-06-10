<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call(
            [
                RoleSeeder::class,
                PizzaSeeder::class,
                ProductSeeder::class
            ]
        );

        User::factory()->count(10)->create();
    }
}
