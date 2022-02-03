<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->enum('role', ['Admin', 'Pegawai', 'Member'])->default('Member');
            $table->string('phone_number');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->date('birth_date')->default('2000-01-01');
            $table->mediumText('address')->nullable();
            $table->timestamps();
            $table->string('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
