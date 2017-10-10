<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->timestamps();
        });

        Schema::table('payment_sources', function (Blueprint $table) {
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
        Schema::drop('payment_sources');

        Schema::table('payment_sources', function (Blueprint $table) {
            //
        });
    }
}
