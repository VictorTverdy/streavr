<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\PaymentSource;

class PopulatePaymentSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pm = new PaymentSource();
        $pm->name = 'N/A';
        $pm->save();

        $pm = new PaymentSource();
        $pm->name = 'Credit Card';
        $pm->save();

        $pm = new PaymentSource();
        $pm->name = 'Seven Eleven';
        $pm->save();

        $pm = new PaymentSource();
        $pm->name = 'Starbucks';
        $pm->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PaymentSource::truncate();
    }
}
