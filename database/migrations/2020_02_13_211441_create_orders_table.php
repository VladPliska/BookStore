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
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('price');
            $table->json('orderInfo');
            $table->integer('phone');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('city');
            $table->string('email');
            $table->string('payType');
            $table->string('post');
            $table->string('status');


//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('book')->references('id')->on('product');

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
        Schema::dropIfExists('orders');
    }
}
