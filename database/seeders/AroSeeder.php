<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Nelia',
                'lastname' => 'Due',
                'email' => 'aro@usm.edu.ph',
                'phone' => '09180001234',
                'role' => 'aro',
                'status' => 'active',
                'password' => bcrypt('123456789'),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
