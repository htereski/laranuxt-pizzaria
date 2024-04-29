<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Employee'
            ],
            [
                'name' => 'Custumer'
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
