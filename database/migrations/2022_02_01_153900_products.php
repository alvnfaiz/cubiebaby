<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->onDelete('cascade');
            $table->string('name');
            $table->string('deskripsi');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('category');
            $table->double('price');
            $table->double('capital');
            $table->enum('status', ['Available', 'Unavailable']);
            $table->integer('stock');
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
        //
        Schema::dropIfExists('products');
    }
}
