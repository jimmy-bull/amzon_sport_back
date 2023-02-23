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
        Schema::table('defeats', function (Blueprint $table) {
            $table->foreign(['game_id'])->references(['id'])->on('ask_games')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defeats', function (Blueprint $table) {
            $table->dropForeign('defeats_game_id_foreign');
        });
    }
};
