<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('video_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id',false,true);
            $table->char('language_id', 2);
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('video_languages', function (Blueprint $table) {
            //
            $table->foreign('video_id')->references('id')->on('videos');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('video_languages', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::drop('video_languages');

    }
}
