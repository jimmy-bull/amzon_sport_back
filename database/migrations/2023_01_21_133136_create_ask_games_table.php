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
        Schema::create('ask_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('who_is_asking');
            $table->string('who_was_asked');
            $table->string('date_of_game');
            $table->string('hours_of_game');
            $table->string('place_of_game');
            $table->string('team_of_asker');
            $table->string('team_of_who_was_asked');
            $table->timestamps();
            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ask_games');
    }
};
