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
        Schema::create('sub_comments_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('main_comment_id')->index('sub_comments_tables_main_comment_id_foreign');
            $table->bigInteger('comment_id');
            $table->longText('comments');
            $table->bigInteger('who_commented_id');
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
        Schema::dropIfExists('sub_comments_tables');
    }
};
