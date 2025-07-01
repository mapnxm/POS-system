<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('payments')->insert([
            'name' => 'cash',
        ]);
        FacadesDB::table('payments')->insert([
            'name' => 'QRIS',
        ]);
        FacadesDB::table('payments')->insert([
            'name' => 'BCA',
        ]);
        FacadesDB::table('payments')->insert([
            'name' => 'BNI',
        ]);
    }
}
