<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('video_id');
            $table->string('meta_key');
            $table->text('meta_value');
            $table->index('video_id', 'video_id');
            $table->index('meta_key', 'meta_key');
        });

        Schema::table('video_meta', function (Blueprint $table) {
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
        Schema::drop('video_meta');

        Schema::table('video_meta', function (Blueprint $table) {
            //
        });
    }
}
