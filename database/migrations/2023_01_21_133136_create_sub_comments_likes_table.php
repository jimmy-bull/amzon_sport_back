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
        Schema::create('sub_comments_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('who_liked_id');
            $table->unsignedBigInteger('main_comment_id')->index('sub_comments_likes_main_comment_id_foreign');
            $table->timestamps();
            $table->integer('comment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_comments_likes');
    }
};
