<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasementSuppliersTable extends Migration
{
    /**      
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasement_suppliers', function (Blueprint $table) {
            $table->id('pch_id');
            $table->string('pch_code')->unique();
            $table->decimal('pch_cost');
            $table->decimal('pch_tax')->nullable();
            $table->decimal('pch_disc')->nullable();
            $table->decimal('pch_ship')->nullable();  
            $table->unsignedBigInteger('s_id');
            $table->text('pch_note')->nullable();
            $table->dateTime('pch_date')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('purchasement_suppliers');
    }
}
