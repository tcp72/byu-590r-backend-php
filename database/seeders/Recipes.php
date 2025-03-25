<?php

namespace Database\Seeders;

use App\Models\recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Recipes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = ([
            [
                'recipe_name' => 'Stroganoff',
                'total_time' => 45, // Example time in minutes
                'file' => 'recipe-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Hamburger',
                'total_time' => 30, // Example time in minutes
                'file' => 'recipe-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Homemade pizza',
                'total_time' => 50, // Example time in minutes
                'file' => 'recipe-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Spaghetti',
                'total_time' => 40, // Example time in minutes
                'file' => 'recipe-4.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Salad',
                'total_time' => 20, // Example time in minutes
                'file' => 'recipe-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        recipe::insert($recipes);
    }
}
