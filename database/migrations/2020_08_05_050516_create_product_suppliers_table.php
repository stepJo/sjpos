<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_suppliers', function (Blueprint $table) {
            $table->id('ps_id');
            $table->string('ps_name');
            $table->string('ps_code');
            $table->integer('ps_price');
            $table->text('ps_desc')->nullable();
            $table->unsignedBigInteger('s_id');
            $table->timestamps();

            $table->foreign('s_id')->references('s_id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_suppliers');
    }
}
