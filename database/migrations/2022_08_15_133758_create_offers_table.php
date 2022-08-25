<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pro_id');
            $table->string('price',10);
            $table->string('status')->comment('0 create 1 accept 2 cancel')->default(0);
            $table->strng('pay_date',30)->default('0000-00-00 00:00:00');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pro_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
