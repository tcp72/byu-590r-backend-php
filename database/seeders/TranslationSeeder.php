<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            [
                'portuguese_ingredient' => 'Tomate',
                'translation_note' => 'vermelho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'portuguese_ingredient' => 'Cebola',
                'translation_note' => 'amarelo é melhor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'portuguese_ingredient' => 'Alho',
                'translation_note' => 'orgânico é melhor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'portuguese_ingredient' => 'Queijo',
                'translation_note' => 'queijo de minas é preferido',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'portuguese_ingredient' => 'Carne',
                'translation_note' => 'de boi ou de porco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Translation::insert($translations);
    }
}
