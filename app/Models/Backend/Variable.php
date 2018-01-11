<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 * @property string $description
 */

class Variable extends Model {
    /**
     * @var string
     */
    protected $table = 'variables';

    /**
     * @var bool
     */
    public $timestamps = true;

}