<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaan')->insert([
            [
                'email' => 'super-admin@gmail.com',
                'nama-pic' => 'Pak Hadi Sisyanto',
                'phone' => '08123456789',
                'alamat' => 'admin',
                'keterangan' => 'Perpanjangan Domain & Hosting www.pasardapurngepul.com (13/08/2020 - 12/08/2021)',
                'nama-website' => 'https://skapsamart.com'
            ] ,
        ]);
    }
}