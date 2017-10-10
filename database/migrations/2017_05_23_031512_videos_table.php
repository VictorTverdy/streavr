<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('video_name');
            $table->integer('video_size');
            $table->string('thumbnail');
            $table->string('thumbnail_url');
            $table->string('video');
            $table->string('video_url');
            $table->bigInteger('ordering');
            $table->date('completed_date')->nullable();
            $table->timestamps();
            $table->tinyInteger('visibility')->default(0);
        });

        Schema::table('videos', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');

        Schema::table('videos', function (Blueprint $table) {
            //
        });
    }
}
