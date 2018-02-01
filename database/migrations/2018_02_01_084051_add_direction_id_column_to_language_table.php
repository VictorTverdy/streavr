<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectionIdColumnToLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('languages', function (Blueprint $table) {
            $table->integer('direction_id', false, true)->default(1);
        });
        Schema::table('languages', function (Blueprint $table) {
            //
            $table->foreign('direction_id')->references('id')->on('directions');
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
        Schema::table('languages', function (Blueprint $table) {
            //
            $table->dropForeign(['direction_id']);
        });

        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('direction_id');
        });

    }
}
