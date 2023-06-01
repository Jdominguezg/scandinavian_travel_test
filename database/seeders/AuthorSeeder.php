<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();


        for($i = 0; $i < 5; $i++) {
            //En cada iteración seleccionamos aleatoriamente el género del autor para tener mayor diversidad.
            $gender = $faker->randomElement(['male', 'female']);
            Author::create([
                'name' => $faker->name($gender),
                'age' => $faker->numberBetween(19,45)
            ]);
        }
    }
}
