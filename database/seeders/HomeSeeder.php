<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Home::create([
           'name'       => 'Fahad Hamza',
           'profession' => 'MERN DEVELOPER',
           'url'        => 'https://www.linkedin.com/public-profile/settings?trk=d_flagship3_profile_self_view_public_profile'
       ]);
    }
}
