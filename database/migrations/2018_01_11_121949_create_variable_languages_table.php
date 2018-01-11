<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariableLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('variable_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variable_id',false,true);
            $table->char('language_id', 2);
            $table->text('description');
            $table->timestamps();
        });
        Schema::table('variable_languages', function (Blueprint $table) {
            //
            $table->foreign('variable_id')->references('id')->on('variables');
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
        Schema::table('variable_languages', function (Blueprint $table) {
            $table->dropForeign(['variable_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::drop('variable_languages');

    }
}
