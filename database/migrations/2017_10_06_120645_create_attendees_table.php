<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('event_id',false,true);
            $table->integer('payment_status_id');
            $table->integer('payment_method_id');
            $table->integer('payment_source_id');
            $table->integer('registration_status_id');
            $table->boolean('allowed');
            $table->timestamps();
        });

        Schema::table('attendees', function (Blueprint $table) {
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
        Schema::table('attendees', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });

        Schema::drop('attendees');
    }

}
