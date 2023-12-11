<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name =["Yangon","Mandalay","Nay Pyi Thaw","Taung Gyi","Mon State","Shan State","Kachin State","Kayar State","Kayin State","Chin","Rakhine","Sagaing","Magway State","Bago","Ayeyarwaddy"];

        $data = [];
        foreach ($name as $key => $value) {
            $data[] = [
                'name' => $value,
                'code' => "MMR00".($key+1),
                'is_legit' => rand(0,1),
            ];
        }

        DB::table('regions')->insert($data);
    }
}
