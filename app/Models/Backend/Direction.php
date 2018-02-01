<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 */

class Direction extends Model {
    /**
     * @var string
     */
    protected $table = 'directions';

    /**
     * @var bool
     */
    public $timestamps = true;

}