<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Makanan',
        ]);

        DB::table('categories')->insert([
            'name' => 'Minuman',
        ]);
        DB::table('categories')->insert([
            'name' => 'Dessert',
        ]);
    }
}
