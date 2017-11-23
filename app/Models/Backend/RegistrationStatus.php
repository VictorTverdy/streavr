<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "registration_statuses".
 *
 * The followings are the available columns in table 'registration_statuses':
 * @property integer $id
 * @property string $name
 */

class RegistrationStatus extends Model {
    /**
     * @var string
     */
    protected $table = 'registration_statuses';

    /**
     * @var bool
     */
    public $timestamps = true;

}