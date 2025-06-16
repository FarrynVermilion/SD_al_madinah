<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            'jabatan' => 'Kepala Sekolah',
            'Kepemilikan jabatan'=> 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'jabatan' => 'Wakil Kepala Sekolah',
            'Kepemilikan jabatan'=> 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'jabatan' => 'Ketua Komite Sekolah',
            'Kepemilikan jabatan'=> 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'jabatan' => 'Wakil Ketua Komite Sekolah',
            'Kepemilikan jabatan'=> 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
