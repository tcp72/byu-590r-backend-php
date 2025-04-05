<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = ([
            [
                'recipe_name' => 'Stroganoff',
                'author_id' => 1, // Reference to an author
                'total_time' => 45, //time in minutes
                'file' => 'images/recipe-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Hamburger',
                'author_id' => 2,
                'total_time' => 30,
                'file' => 'images/recipe-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Homemade pizza',
                'author_id' => 1, //nice. repeat
                'total_time' => 50,
                'file' => 'images/recipe-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Spaghetti',
                'author_id' => 3,
                'total_time' => 40,
                'file' => 'images/recipe-4.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_name' => 'Salad',
                'author_id' => 2,
                'total_time' => 20,
                'file' => 'images/recipe-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Recipe::insert($recipes);
    }
}
