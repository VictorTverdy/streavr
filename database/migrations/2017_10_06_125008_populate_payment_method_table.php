<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\PaymentMethod;

class PopulatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pm = new PaymentMethod();
        $pm->name = 'N/A';
        $pm->save();

        $pm = new PaymentMethod();
        $pm->name = 'Credit Card';
        $pm->save();

        $pm = new PaymentMethod();
        $pm->name = 'QR';
        $pm->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PaymentMethod::truncate();
    }
}
