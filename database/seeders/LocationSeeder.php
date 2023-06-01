<?php

namespace Database\Seeders;

use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();


        for($i = 0; $i < 2; $i++) {
            Location::create([
                'name' => $faker->streetAddress
            ]);
        }
    }
}
