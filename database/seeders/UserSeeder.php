<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password')
            ] ,

            [
                'name' => 'Super Admin User',
                'username' => 'superadminuser',
                'email' => 'super-admin@gmail.com',
                'role' => 'super-admin',
                'status' => 'active',
                'password' => bcrypt('password')
            ] ,

        ]);
    }
}