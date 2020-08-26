<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Cashier',
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Writer',
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);
    }
}
