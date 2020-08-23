<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            'b_name' => 'Cabang Kedoya',
            'b_email' => 'kedoya@email.com',
            'b_contact' => '+62 0867 9045',
            'b_address' => 'Jakarta',
            'b_status' => 1,
        ]);	
    }
}
