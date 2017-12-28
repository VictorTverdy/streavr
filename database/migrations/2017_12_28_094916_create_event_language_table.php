<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('event_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id',false,true);
            $table->char('language_id', 2);
            $table->string('name');
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('event_languages', function (Blueprint $table) {
            //
            $table->foreign('event_id')->references('id')->on('events');
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
        Schema::table('event_languages', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::drop('event_languages');
    }
}
