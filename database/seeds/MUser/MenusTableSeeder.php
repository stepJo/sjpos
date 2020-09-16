<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'menu_name' => 'POS'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Cabang'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Produk Cabang'
        ]);
            
        DB::table('menus')->insert([
            'menu_name' => 'Pelanggan'
        ]);
        
        DB::table('menus')->insert([
            'menu_name' => 'Riwayat Transaksi'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Diskon Produk'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Kategori'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Satuan'
        ]);
            
        DB::table('menus')->insert([
            'menu_name' => 'Produk'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Barcode'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Penyuplai'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Data Barang'
        ]);

        DB::table('menus')->insert([
            'menu_name' => 'Pembelian Barang'
        ]);
    }
}
