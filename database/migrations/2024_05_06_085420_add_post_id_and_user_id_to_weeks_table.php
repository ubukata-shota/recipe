<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostIdAndUserIdToWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weeks', function (Blueprint $table) {
            $table->bigInteger('post_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weeks', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('post_id');
            $table->dropColumn('user_id');
        });
    }
}
