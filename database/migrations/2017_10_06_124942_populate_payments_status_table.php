<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\PaymentStatus;

class PopulatePaymentsStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pm = new PaymentStatus();
        $pm->name = 'N/A';
        $pm->save();

        $pm = new PaymentStatus();
        $pm->name = 'Declined';
        $pm->save();

        $pm = new PaymentStatus();
        $pm->name = 'Successful';
        $pm->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PaymentStatus::truncate();
    }
}
