<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\MUser\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $roles = Role::where('role_name', 'Super Admin')->first();

        DB::table('users')->insert([
            'u_name'     => 'Stephen Jonathan',
            'u_email'    => 'stepjodevtest1@gmail.com',
            'u_contact'  => '087785572292',
            'u_password' => Hash::make('12345678'),
            'role_id'    => $roles->role_id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);
    }
}
