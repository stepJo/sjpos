<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('td_id');
            $table->unsignedBigInteger('t_id');
            $table->unsignedBigInteger('p_id');
            $table->integer('qty');
            $table->integer('sub_total');
            $table->timestamps();

            $table->foreign('t_id')->references('t_id')->on('transactions')->onDelete('cascade');
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
