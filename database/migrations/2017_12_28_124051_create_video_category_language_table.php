<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCategoryLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('video_category_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_category_id',false,true);
            $table->char('language_id', 2);
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('video_category_languages', function (Blueprint $table) {
            //
            $table->foreign('video_category_id')->references('id')->on('video_categories');
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
        Schema::table('video_category_languages', function (Blueprint $table) {
            $table->dropForeign(['video_category_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::drop('video_category_languages');
    }
}
