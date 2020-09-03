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
            'b_code' => 'KEDOYA',
            'b_name' => 'Cabang Kedoya',
            'b_email' => 'kedoya@email.com',
            'b_contact' => '+62 0867 9045',
            'b_address' => 'Jakarta',
            'b_status' => 1,
        ]);	

        DB::table('branches')->insert([
            'b_code' => 'SIMATUPANG',
            'b_name' => 'Cabang Simatupang',
            'b_email' => 'simatupang@email.com',
            'b_contact' => '+62 5907 9245',
            'b_address' => 'Jakarta',
            'b_status' => 1,
        ]);	

        DB::table('branches')->insert([
            'b_code' => 'JOGJA',
            'b_name' => 'Cabang Jogja',
            'b_email' => 'jogja@email.com',
            'b_contact' => '+62 9201 3096',
            'b_address' => 'Jogja',
            'b_status' => 1,
        ]);	
    }
}
