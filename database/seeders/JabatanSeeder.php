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
            'nama_jabatan' => 'Kepala Sekolah',
            'jenis_jabatan'=> 0,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => 'Wakil Kepala Sekolah',
            'jenis_jabatan'=> 0,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => 'Ketua Komite Sekolah',
            'jenis_jabatan'=> 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('jabatan')->insert([
            'nama_jabatan' => 'Wakil Ketua Komite Sekolah',
            'jenis_jabatan'=> 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
