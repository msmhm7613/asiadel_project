<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('offer_id');
            $table->string('price',10);
            $table->string('pay_status',1)->comment('0 create 1 payed 2 fail_pay')->default(0);
            $table->string('status',1)->comment('0 create 1 register 2 sending')->default(0);
            $table->string('cellphone',11);
            $table->string('address');

            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('pro_id')->references('id')->on('products');
            $table->foreign('offer_id')->references('id')->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
