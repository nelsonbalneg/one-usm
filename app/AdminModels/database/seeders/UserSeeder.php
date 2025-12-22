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
        DB::table('users')->insert([
            [
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '09273964833',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
            ],
            [
                'firstname' => 'utdc',
                'lastname' => 'utdc',
                'email' => 'utdc@gmail.com',
                'phone' => '09553487332',
                'role' => 'utdc',
                'status' => 'active',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
            ],
            [
                'firstname' => 'SFirstName',
                'lastname' => 'SLastname',
                'email' => 'student@gmail.com',
                'phone' => '09616549875',
                'role' => 'student',
                'status' => 'active',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
