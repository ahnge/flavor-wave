<?php

namespace Database\Seeders;

use App\Services\DataSets\ProductData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data  = ProductData::get();

        \App\Models\Product::insert($data);

    }
}
