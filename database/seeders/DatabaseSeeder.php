<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CarSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(LocationSeeder::class);
    }
}
