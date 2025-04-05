<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipeIngredients = [
            // Stroganoff ingredients
            [
                'recipe_id' => 1,
                'ingredient_id' => 5, // Beef
                'quantity' => 500, // 500g
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2, // Onion
                'quantity' => 2, // 2 onions
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Hamburger ingredients
            [
                'recipe_id' => 2,
                'ingredient_id' => 5, // Beef
                'quantity' => 300, // 300g
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 1, // Tomato
                'quantity' => 1, // 1 tomato
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Pizza ingredients
            [
                'recipe_id' => 3,
                'ingredient_id' => 4, // Cheese
                'quantity' => 200, // 200g
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 1, // Tomato
                'quantity' => 3, // 3 tomatoes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Spaghetti ingredients
            [
                'recipe_id' => 4,
                'ingredient_id' => 3, // Garlic
                'quantity' => 2, // 2 cloves
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 1, // Tomato
                'quantity' => 4, // 4 tomatoes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Salad ingredients
            [
                'recipe_id' => 5,
                'ingredient_id' => 1, // Tomato
                'quantity' => 2, // 2 tomatoes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 2, // Onion
                'quantity' => 1, // 1 onion
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('recipe_ingredients')->insert($recipeIngredients);
    }
}
