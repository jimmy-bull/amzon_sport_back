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
        Schema::table('sub_comments_likes', function (Blueprint $table) {
            $table->foreign(['main_comment_id'])->references(['main_comment_id'])->on('sub_comments_tables')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_comments_likes', function (Blueprint $table) {
            $table->dropForeign('sub_comments_likes_main_comment_id_foreign');
        });
    }
};
