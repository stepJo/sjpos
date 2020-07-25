<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\MProduct\Category;
use App\Models\MProduct\Product;
use App\Models\MProduct\Unit;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        $faker = \Faker\Factory::create('id_ID');

        $data = [];

        $categories = collect(Category::all()->modelKeys());
        $units = collect(Unit::all()->modelKeys());

        for($i = 0;  $i < 200; $i++) {
            $data[] = [
                'p_code'     => $faker->unique()->randomNumber(),
                'cat_id'     => $categories->random(),
                'p_name'     => 'Produk '.(int)($i + 1),
                'unit_id'    => $units->random(),
                'p_price'    => $faker->numberBetween(5000, 100000),
                'p_status'   => 1,  
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }

        Product::insert($data);
    }
}
