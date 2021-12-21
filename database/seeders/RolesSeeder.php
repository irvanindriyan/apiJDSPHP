<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'Admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'role' => 'User',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
