<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Programming;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            "Technology", "Tutorials", "Tips", "Website", "Frontend", "Backend", "Devops",
        ];

        $programmings = [
            "PHP", "Laravel", "Nodejs", "Reactjs", "Expressjs", "Nestjs", "Nextjs", "AWS", "Digital Ocean"
        ];

        foreach($tags as $t)
        {
            Tag::create([
                'slug' => Str::slug($t),
                'name' => $t
            ]);
        }

        foreach($programmings as $p)
        {
            Programming::create([
                'slug' => Str::slug($p),
                'name' => $p
            ]);
        }
    }
}
