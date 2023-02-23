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
        Schema::create('team_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wichteamrated');
            $table->double('punctuality', 8, 2);
            $table->double('fair_play', 8, 2);
            $table->double('teamrated', 8, 2);
            $table->timestamps();
            $table->string('status');
            $table->string('team_rated_name');
            $table->unsignedBigInteger('game_id')->index('team_rates_game_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_rates');
    }
};
