<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_replies', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('id')->on('reports');
            $table->string('image')->nullable();
            $table->mediumText('value');
            $table->timestamp('reply_at')->useCurrent();
            $table->boolean('read')->default(false);
            $table->enum('status', ['inbox', 'outbox'])->default('inbox');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_replies');
    }
}
