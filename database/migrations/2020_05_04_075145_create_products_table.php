<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('p_id');
            $table->string('p_code')->unique();
            $table->unsignedBigInteger('cat_id');
            $table->string('p_name')->unique();
            $table->text('p_desc')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->integer('p_price');
            $table->string('p_image')->nullable();
            $table->string('p_barcode')->nullable();
            $table->integer('p_status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('cat_id')->references('cat_id')->on('categories')->onDelete('cascade');
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
