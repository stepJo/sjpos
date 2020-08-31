<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id('pro_id');
            $table->string('pro_code')->unique();
            $table->string('pro_type');
            $table->string('pro_name');
            $table->string('pro_barc')->nullable();
            $table->integer('min_trans');
            $table->string('pro_disc')->nullable();
            $table->integer('pro_value')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('b_id');
            $table->unsignedBigInteger('u_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promos');
    }
}
