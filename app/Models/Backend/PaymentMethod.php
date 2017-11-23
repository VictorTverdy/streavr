<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "payment_methods".
 *
 * The followings are the available columns in table 'payment_methods':
 * @property integer $id
 * @property string $name
 */

class PaymentMethod extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_methods';

    /**
     * @var bool
     */
    public $timestamps = true;

}