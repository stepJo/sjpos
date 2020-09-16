<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('t_id');
            $table->unsignedBigInteger('c_id')->nullable();
            $table->string('t_code')->unique();
            $table->string('t_type');
            $table->decimal('t_total');
            $table->decimal('t_tax')->nullable();
            $table->decimal('t_disc')->nullable();
            $table->dateTime('t_date')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            
            $table->foreign('c_id')->references('c_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
