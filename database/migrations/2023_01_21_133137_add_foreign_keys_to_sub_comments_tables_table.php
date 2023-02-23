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
        Schema::table('sub_comments_tables', function (Blueprint $table) {
            $table->foreign(['main_comment_id'])->references(['id'])->on('comments')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_comments_tables', function (Blueprint $table) {
            $table->dropForeign('sub_comments_tables_main_comment_id_foreign');
        });
    }
};
