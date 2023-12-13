<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Distributor::factory()->count(10)->create();
        Distributor::factory()->create([
            'name' => "Test Distributor",
            "address" => "Test Address",
            "phone_number" => "0987654321",
            "email" => "test@gmail.com",
            'password' => bcrypt('password'),
            'region_code'  => "MMR001"
        ]);
    }
}
