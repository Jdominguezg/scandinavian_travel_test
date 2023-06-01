<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();


        for($i = 0; $i < 50; $i++) {

            $title = $faker->sentence;

            //Comprobamos que el título sea único para evitar problemas de SEO
            while(Post::where('title', $title)->exists()){
                $title = $faker->sentence;
            }

            //Al generar títutlos únicos podemos sacar el slug del propio título.
            $slug = Str::slug($title, '-');

            Post::create([
                'slug' => $slug,
                'title' => $title
            ]);
        }
    }
}
