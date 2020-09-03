<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPurchasementSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_purchasement_suppliers', function (Blueprint $table) {
            $table->id('dps_id');
            $table->unsignedBigInteger('pch_id');
            $table->unsignedBigInteger('ps_id');
            $table->integer('qty');
            $table->decimal('sub_total');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('pch_id')->references('pch_id')->on('purchasement_suppliers')->onDelete('cascade');
            $table->foreign('ps_id')->references('ps_id')->on('product_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_purchasement_suppliers');
    }
}
