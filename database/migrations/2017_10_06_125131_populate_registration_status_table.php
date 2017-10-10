<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\RegistrationStatus;

class PopulateRegistrationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pm = new RegistrationStatus();
        $pm->name = 'N/A';
        $pm->save();

        $pm = new RegistrationStatus();
        $pm->name = 'Paid';
        $pm->save();

        $pm = new RegistrationStatus();
        $pm->name = 'RSVPd';
        $pm->save();

        $pm = new RegistrationStatus();
        $pm->name = 'Payment Declined';
        $pm->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        RegistrationStatus::truncate();
    }
}
