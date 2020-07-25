<?php

use Illuminate\Database\Seeder;
use App\Models\MUser\User;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$user = User::first();

        DB::table('discounts')->insert([
        	'dis_code'   => '12345678',
        	'dis_type'   => 'Fix',
        	'min_trans'  => 20000,
            'dis_value'  => 25000,
            'dis_qty'    => 25,
        	'exp_date'   => '2020-11-01',
        	'u_id' 		 => $user->u_id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        DB::table('discounts')->insert([
        	'dis_code'   => '87654321',
        	'dis_type'   => 'Percent',
        	'min_trans'  => 55000,
            'dis_value'  => 10,
            'dis_qty'    => 10,
        	'exp_date'   => '2020-12-03',
        	'u_id' 		 => $user->u_id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);
    }
}
