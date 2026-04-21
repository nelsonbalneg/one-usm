<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('portal_users')->insert([
            [
                'student_id' => '11-111111',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('123456789'),
                'created_at' => Carbon::now(),
            ],
            [
                'student_id' => '00-00000',
                'email' => 'student@gmail.com',
                'role' => 'student',
                'status' => 'active',
                'password' => bcrypt('123456789'),
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
