<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Ryan',
                'lastname' => 'Gonzaga',
                'email' => 'pao@usm.edu.ph',
                'phone' => '09190920583',
                'role' => 'pao',
                'status' => 'active',
                'password' => bcrypt('123456789'),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
