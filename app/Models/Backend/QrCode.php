<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "qr_codes".
 *
 * The followings are the available columns in table 'qr_codes':
 * @property integer $id
 * @property integer $event_id
 * @property string $key
 * @property string $qr_code
 * @property integer $payment_source_id
 * @property integer $is_used
 */

class QrCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'qr_codes';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function event()
    {
        return $this->belongsTo('App\Models\Backend\Event');
    }

    public function paymentSource()
    {
        return $this->belongsTo('App\Models\Backend\PaymentSource');
    }


}