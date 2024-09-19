<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'profile_image' => 'images/2bITWSXMtVxmyiULEkXDrQLuSvdLwPkh5wHeWMNO.png',
            'description'   => 'As a MERN developer, I specialize in crafting dynamic and efficient web applications using the MERN stack: MongoDB, Express.js, React.js, and Node.js. This technology stack enables me to build full-stack applications with a seamless integration between the database, server, and client-side.',
            'user_cv'       => 'user_cv/1qaIIjTljceJUlXgQhJchcC2b1aHbQqtewwZlpG3.pdf'
        ]);
    }
}
