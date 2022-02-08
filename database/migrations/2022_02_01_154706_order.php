<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('total_price');
            $table->enum('status_payment', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->enum('shipping_status', ['Diproses', 'Dikirim', 'Selesai'])->default('Diproses');
            $table->string('resi_number')->nullable();
            $table->enum('order_status', ['Proses','Expired', 'Cancel', 'Selesai'])->default('Proses');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
            $table->date('expired_at');
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
    }
}
