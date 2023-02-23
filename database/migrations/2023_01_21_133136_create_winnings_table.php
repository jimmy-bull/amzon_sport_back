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
        Schema::create('winnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_id')->index('winnings_game_id_foreign');
            $table->bigInteger('score');
            $table->string('winner_mail');
            $table->string('winner_team');
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
        Schema::dropIfExists('winnings');
    }
};
