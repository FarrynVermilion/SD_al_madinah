<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin_admin',
            'email' => 'admin@nowui.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'Admin_tata_usaha',
            'email' => 'testTataUsaha@gmail.com',
            'password' => Hash::make('papantulis'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Admin_guru',
            'email' => 'testGuru@gmail.com',
            'password' => Hash::make('papantulis'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 2
        ]);
        DB::table('users')->insert([
            'name' => 'Admin_siswa',
            'email' => 'testSiswa@gmail.com',
            'password' => Hash::make('papantulis'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 3
        ]);
    }
}
