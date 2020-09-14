<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'app_name'    => 'Mobisto POS',
            'app_email'   => 'mobisto@email.com',
            'app_contact' => '+62 877 8557 2292',
            'app_address' => 'BSD'
        ]);
    }
}
