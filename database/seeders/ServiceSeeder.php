<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name'          => 'Mern Stack',
            'description'   => 'As a MERN developer, I specialize in crafting dynamic and efficient web applications using the MERN stack: MongoDB, Express.js, React.js, and Node.js. This technology stack enables me to build full-stack applications with a seamless integration between the database, server, and client-side.',
            'image'         => 'images/bbU17s01bPOgcQbNSl7TANYawz5no9qMitkhhld7.png'
        ]);
    }
}
