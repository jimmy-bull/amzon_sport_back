<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('price');
            $table->timestamps();
            $table->integer('article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_dates');
    }
};
