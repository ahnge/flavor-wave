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
                "name" =>  "Sale2",
                "email" =>  "sale2@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Sale->value
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
                "name" =>  "Warehouse2",
                "email" =>  "warehouse2@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Warehouse->value
            ],
            [
                "name" =>  "Driver Ko Kyaw",
                "email" =>  "truckDriver@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ],
            [
                "name" =>  "Htet Shine",
                "email" =>  "htetshine.htetmkk@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ],
            [
                "name" =>  "winstownwinn",
                "email" =>  "winstonwinn2000@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ],
            [
                "name" =>  "coin",
                "email" =>  "htetshine.coin@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ],
            [
                "name" =>  "flavorsale",
                "email" =>  "sale.flavorwave@gmail.com",
                "password" =>  bcrypt("12345678"),
                "role_id" =>  RoleEnum::Driver->value
            ],

        ];

        \App\Models\User::insert($data);
    }
}
