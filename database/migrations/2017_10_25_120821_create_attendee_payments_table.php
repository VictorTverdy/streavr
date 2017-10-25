<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('attendee_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendee_id',false,true);
            $table->decimal('amount', 10, 2);
            $table->string('payment_id', 255);
            $table->timestamps();
        });

        Schema::table('attendee_payments', function (Blueprint $table) {
            //
            $table->foreign('attendee_id')->references('id')->on('attendees');
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
        Schema::table('attendee_payments', function (Blueprint $table) {
            $table->dropForeign(['attendee_id']);
        });

        Schema::drop('attendee_payments');
    }
}
