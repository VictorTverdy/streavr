<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "payment_statuses".
 *
 * The followings are the available columns in table 'payment_statuses':
 * @property integer $id
 * @property string $name
 */


class PaymentStatus extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_statuses';

    /**
     * @var bool
     */
    public $timestamps = true;

}