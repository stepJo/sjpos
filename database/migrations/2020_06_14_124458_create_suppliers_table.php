<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('s_id');
            $table->string('s_code')->unique();
            $table->string('s_name');
            $table->string('s_email')->nullable();
            $table->string('s_contact')->nullable();
            $table->string('s_bank')->nullable();
            $table->string('s_bank_num')->nullable();
            $table->text('s_address')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
