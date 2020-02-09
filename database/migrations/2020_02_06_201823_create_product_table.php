<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',150);
            $table->text('description');
            $table->integer('price');
            $table->text('img');
            $table->integer('ganre')->unsigned();
            $table->integer('wathed')->nullable();
            $table->boolean('action')->default(false);

            $table->foreign('ganre')->references('id')->on('ganres');
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
        Schema::dropIfExists('product');
    }
}
