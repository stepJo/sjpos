<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(ProfilesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
