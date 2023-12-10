<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = ["Admin","Sale","Logistic","Warehouse","Factory","Driver"];

        $data = [];
        foreach ($title as $key => $value) {
            $data[] = [
                'title' => $value,
            ];
        }

        DB::table('roles')->insert($data);
    }
}
