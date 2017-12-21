<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\Language;

class PopulateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pm = new Language();
        $pm->id = 'en';
        $pm->name = 'English';
        $pm->save();

        $pm = new Language();
        $pm->id = 'id';
        $pm->name = 'Indonesia';
        $pm->save();

        $pm = new Language();
        $pm->id = 'fa';
        $pm->name = 'Persian';
        $pm->save();

        $pm = new Language();
        $pm->id = 'ms';
        $pm->name = 'Malaysia';
        $pm->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Language::truncate();
    }
}
