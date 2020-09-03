<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	DB::table('units')->insert([
        	'unit_name' => 'KG',
        ]);	

        DB::table('units')->insert([
        	'unit_name' => 'pcs',
        ]);	

        DB::table('units')->insert([
        	'unit_name' => 'item',
        ]);	
    }
}
