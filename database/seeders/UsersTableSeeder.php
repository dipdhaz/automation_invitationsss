<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
            'nik' => '30294828482',
            'nomor_paspor' => 'VNUJNVUJ',
            'nama_lengkap' => 'RENI ANGGRINI',
            'jenis_kelamin' => 'L',
            'alamat' => 'SKUDAI LAMA',
            'tahapan' => 'DPT',
            'tps' => '001',
            'desa_kelurahan' => 'Johor Bahru',
            'created_at' => now(), // You may need to adjust this based on your requirements
            'updated_at' => now(),
        ]);
    }
}
