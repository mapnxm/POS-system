<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create('id-ID');

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', 
            'password' => bcrypt('12345678'),
        ]);

        // Create 10 random users
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => bcrypt('password'),
        //     ]);
        // }
    }
}
