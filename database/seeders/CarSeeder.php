<?php

namespace Database\Seeders;

use App\Models\Car;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() :void
    {
        $faker = Factory::create();

        for($i = 0; $i < 20; $i++) {
            Car::create([
                'brand' => $faker->randomElement(['Toyota', 'Kia', 'Hyundai', 'Dacia', 'Jeep', 'Skoda', 'Nissan', 'Suzuki', 'BMW', 'Subaru', 'Mitsubishi', 'Tesla', 'Renault', 'Mrecedes', 'VW']),
                'model' => $faker->word
            ]);
        }
    }
}
