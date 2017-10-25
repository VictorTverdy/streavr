<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

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