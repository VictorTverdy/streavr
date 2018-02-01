<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backend\Direction;

class PopulateDirectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dir = new Direction();
        $dir->id = 1;
        $dir->name = 'Left';
        $dir->save();

        $dir = new Direction();
        $dir->id = 2;
        $dir->name = 'Right';
        $dir->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Direction::truncate();
    }
}
