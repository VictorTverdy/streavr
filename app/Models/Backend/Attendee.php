<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

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