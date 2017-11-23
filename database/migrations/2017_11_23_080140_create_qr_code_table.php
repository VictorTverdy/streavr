<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id',false,true);
            $table->string('key', 255);
            $table->string('qr_code', 255);
            $table->timestamps();
        });

        Schema::table('qr_codes', function (Blueprint $table) {
            //
            $table->foreign('event_id')->references('id')->on('events');
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
        Schema::table('qr_codes', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });

        Schema::drop('qr_codes');
    }
}
