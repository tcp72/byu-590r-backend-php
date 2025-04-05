<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'ingredient_name' => 'Tomato',
                'ingredient_note' => 'red',
                'translation_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Onion',
                'ingredient_note' => 'Yellow onions preferred',
                'translation_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Garlic',
                'ingredient_note' => 'organic is best',
                'translation_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Cheese',
                'ingredient_note' => 'from Minas Gerais is best',
                'translation_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Meat of choice',
                'ingredient_note' => 'beef or pork ',
                'translation_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Ingredient::insert($ingredients);
    }
}
