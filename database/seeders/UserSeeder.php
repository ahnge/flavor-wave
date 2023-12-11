<?php

namespace Database\Seeders;

use App\Constants\RoleEnum;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  [
            [
                "name" =>  "Admin",
                "email" =>  "admin@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Admin->value
            ],
            [
                "name" =>  "Sale",
                "email" =>  "sale@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Sale->value
            ],
            [
                "name" =>  "Logistic",
                "email" =>  "logistic@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Logistic->value
            ],
            [
                "name" =>  "Warehouse",
                "email" =>  "warehouse@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Warehouse->value
            ],
            [
                "name" =>  "Factory",
                "email" =>  "factory@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Factory->value
            ],
            [
                "name" =>  "Driver",
                "email" =>  "truckDriver@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ]
        ];

        \App\Models\User::insert($data);

    }
}
