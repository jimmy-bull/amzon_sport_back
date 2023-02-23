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
        Schema::create('defeats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_id')->index('defeats_game_id_foreign');
            $table->bigInteger('score');
            $table->string('looser_mail');
            $table->string('looser_team');
            $table->timestamps();
            $table->bigInteger('score_2');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defeats');
    }
};
