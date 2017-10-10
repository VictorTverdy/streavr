<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('meta_key');
            $table->text('meta_value');

            $table->index('user_id', 'user_id');
            $table->index('meta_key', 'meta_key');
        });

        Schema::table('user_meta', function (Blueprint $table) {
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
        Schema::drop('user_meta');

        Schema::table('user_meta', function (Blueprint $table) {
            //
        });
    }
}
