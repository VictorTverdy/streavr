<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('distributors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->integer('payment_source_id', false, true);
            $table->timestamps();
        });

        Schema::table('distributors', function (Blueprint $table) {
            //
            $table->foreign('payment_source_id')->references('id')->on('payment_sources');
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
        Schema::table('distributors', function (Blueprint $table) {
            $table->dropForeign(['payment_source_id']);
        });

        Schema::drop('distributors');
    }
}
