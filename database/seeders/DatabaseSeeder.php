<?php

namespace Database\Seeders;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\DataSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DataSeeder::class,
         ]);
    }
}
