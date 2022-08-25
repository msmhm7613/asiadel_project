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
            $table->id();
            $table->string('title',100);
            $table->string('slug',100)->unique();
            $table->string('image')->default('default.png');
            $table->longText('body');
            $table->string('price',10);
            $table->json('attrs');
            $table->unsignedBigInteger('created_id');
            $table->string('status',1)->comment('0 create 1 sailed')->default(0);
            $table->string('from_date');
            $table->string('to_date');
            $table->string('pay_date')->comment('120 min');
            $table->string('is_delete',1)->default(0);

            $table->timestamps();

            $table->foreign('created_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
