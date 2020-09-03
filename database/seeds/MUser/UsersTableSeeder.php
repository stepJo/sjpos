<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\MBranch\Branch;
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
        $role = Role::first();
        $branch = Branch::first();

        DB::table('users')->insert([
            'u_name'     => 'Stephen Jonathan',
            'u_email'    => 'stepjodevtest1@gmail.com',
            'u_contact'  => '087785572292',
            'u_password' => Hash::make('12345678'),
            'b_id'       => $branch->b_id,
            'role_id'    => $role->role_id,
        ]);

        DB::table('users')->insert([
            'u_name'     => 'Alfian',
            'u_email'    => 'alfian@yahoo.com',
            'u_contact'  => '+62 0668 2105 90',
            'u_password' => Hash::make('12345678'),
            'b_id'       => $branch->b_id,
            'role_id'    => $role->role_id,
        ]);
    }
}
