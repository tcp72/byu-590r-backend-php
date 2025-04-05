<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'author_name' => 'Julia Child',
                'author_home_town' => 'Pasadena',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_name' => 'Gordon Ramsay',
                'author_home_town' => 'London',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_name' => 'Ina Garten',
                'author_home_town' => 'New York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Author::insert($authors);
    }
}
