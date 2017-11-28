<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $payment_source_id
  */


class Distributor extends Model
{
    /**
     * @var string
     */
    protected $table = 'distributors';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function paymentSource()
    {
        return $this->hasOne('App\Models\Backend\PaymentSource','id','payment_source_id');
    }
}
