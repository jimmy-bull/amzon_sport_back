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
        Schema::create('teammembers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('team_to_join');
            $table->string('who_want_to_join');
            $table->string('team_to_join_owner');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('notifications_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teammembers');
    }
};
