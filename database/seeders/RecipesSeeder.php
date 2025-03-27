<?php

namespace Database\Seeders;

use App\Models\Recipes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RecipesSeeder extends Seeder
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
                'file' => 'images/recipe-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Hamburger',
                'total_time' => 30, // Example time in minutes
                'file' => 'images/recipe-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Homemade pizza',
                'total_time' => 50, // Example time in minutes
                'file' => 'images/recipe-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Spaghetti',
                'total_time' => 40, // Example time in minutes
                'file' => 'images/recipe-4.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Salad',
                'total_time' => 20, // Example time in minutes
                'file' => 'images/recipe-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Recipes::insert($recipes);
    }
}
