<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            ['name' => 'Lab Komputer', 'capacity' => 40, 'type' => 'Lab', 'is_active' => true],
            ['name' => 'Ruang Kelas N35', 'capacity' => 40, 'type' => 'Kelas', 'is_active' => true],
            ['name' => 'Ruang Kelas N36', 'capacity' => 40, 'type' => 'Kelas', 'is_active' => true],
            ['name' => 'Ruang Kelas K3', 'capacity' => 35, 'type' => 'Kelas', 'is_active' => true],
        ]);
    }
}