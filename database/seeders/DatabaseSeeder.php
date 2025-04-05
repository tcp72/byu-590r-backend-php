<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AuthorSeeder::class,      // Add this
            TranslationSeeder::class, // Add this
            IngredientSeeder::class,  // Add this
            RecipeSeeder::class,
            RecipeIngredientSeeder::class, // Add this
        ]);
    }
}
