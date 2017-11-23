<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "attendee_payments".
 *
 * The followings are the available columns in table 'attendee_payments':
 * @property integer $id
 * @property integer $attendee_id
 * @property float $amount
 * @property string $payment_id
 */

class AttendeePayment extends Model {
    /**
     * @var string
     */
    protected $table = 'attendee_payments';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function attendee()
    {
        return $this->belongsTo('App\Models\Attendee');
    }
}