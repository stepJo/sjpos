<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_products', function (Blueprint $table) {
            $table->id('dp_id');
            $table->unsignedBigInteger('p_id');
            $table->integer('dp_value');
            $table->integer('dp_status');

            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_products');
    }
}
