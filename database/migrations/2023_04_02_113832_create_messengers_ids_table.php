<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengersIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messengers_ids', function (Blueprint $table) {
            $table->id();
            $table->foreignId("users_id")->constrained()->cascadeOnDelete();
            // this method create an users_id column with type UNSIGNED BIGINT
            // and use a convention to determine the name of the table and column we should work with
            $table->string("unique_messengers_id");
            $table->string("user_email");
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
        Schema::dropIfExists('messengers_ids');
    }
}
