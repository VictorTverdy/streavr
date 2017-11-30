<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "payment_sources".
 *
 * The followings are the available columns in table 'payment_sources':
 * @property integer $id
 * @property string $name
 */

class PaymentSource extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_sources';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function distributor()
    {
        return $this->hasOne('App\Models\Backend\Distributor');
    }


}