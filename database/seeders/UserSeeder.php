<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the user's table.
     */
    public function run(): void
    {
        User::create([
                'name'     => 'ahmad sajjad',
                'email'    => 'ahmadsajjad121@example.com',
                'password' => Hash::make('password123'),
        ]);
    }
}
