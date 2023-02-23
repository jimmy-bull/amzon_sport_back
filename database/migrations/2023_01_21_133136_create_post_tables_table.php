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
        Schema::create('post_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('title');
            $table->unsignedBigInteger('user_id')->index('post_tables_user_id_foreign');
            $table->string('who_can_see');
            $table->string('status');
            $table->timestamps();
            $table->string('post_type')->default('regular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tables');
    }
};
