<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "shwephuehmone",
            'email' => "shwe@gmail.com",
            'password' => Hash::make('shwe'),
        ]);
        Admin::create([
            'name' => "Admin Phue",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
            'image' => "default.jpg"
        ]);
    }
}
