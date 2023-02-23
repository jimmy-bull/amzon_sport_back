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
        Schema::table('image_video_tables', function (Blueprint $table) {
            $table->foreign(['post_id'])->references(['id'])->on('post_tables')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_video_tables', function (Blueprint $table) {
            $table->dropForeign('image_video_tables_post_id_foreign');
        });
    }
};
