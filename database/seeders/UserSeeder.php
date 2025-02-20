<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Trevor Christiansen',
                'email' => 'Trevor@gmail.com',
                'email_verified_at' => null,
                'password' => bcrypt('Funnybunny1990'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ];
        User::insert($users);
    }
}
