<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	DB::table('categories')->insert([
        	'cat_name' => 'Makanan',
        ]);

        DB::table('categories')->insert([
            'cat_name' => 'Sayuran',
        ]);

        DB::table('categories')->insert([
            'cat_name' => 'Goreng',
        ]);
    }
}
