<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "attendees".
 *
 * The followings are the available columns in table 'attendees':
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $payment_status_id
 * @property integer $payment_method_id
 * @property integer $payment_source_id
 * @property integer $registration_status_id
 * @property integer $allowed
 * @property integer $qr_code_id
 */

class Attendee extends Model {
    /**
     * @var string
     */
    protected $table = 'attendees';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\Backend\PaymentMethod');
    }

    public function paymentStatus()
    {
        return $this->belongsTo('App\Models\Backend\PaymentStatus');
    }

    public function paymentSource()
    {
        return $this->belongsTo('App\Models\Backend\PaymentSource');
    }

    public function registrationStatus()
    {
        return $this->belongsTo('App\Models\Backend\RegistrationStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Backend\Event');
    }

}