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
        Schema::create('subcomments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('comment_id');
            $table->longText('comments');
            $table->bigInteger('who_commented_id');
            $table->timestamps();
            $table->bigInteger('main_comment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcomments');
    }
};
