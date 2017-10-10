<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Attendee;

class Event extends Model {
    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @var bool
     */
    public $timestamps = true;



    public function attendees()
    {
        return $this->hasMany('App\Models\Backend\Attendee','event_id','id');
    }

}