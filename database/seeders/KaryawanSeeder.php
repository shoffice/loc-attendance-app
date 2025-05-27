<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Tambahkan facade Hash
use Illuminate\Support\Str;


class KaryawanSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Karyawan::factory()->count(5)->create();

        // DB::table('karyawan')->insert([
        //     'nik' => '12345',
        //     'email' => 'shofi@gmail.com',
        //     'nama_lengkap' => 'Shofi',
        //     'jabatan' => 'head',
        //     'no_hp' => '1232131',
        //     'password' => Hash::make('12345'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
