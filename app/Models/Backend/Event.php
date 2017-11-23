<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Attendee;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $thumbnail
 * @property string $thumbnail_url
 * @property string  $time_start
 * @property float  $time_length
 * @property integer $is_active
 * @property string $title
 * @property string $subtitle
 * @property string $background_img
 * @property string $background_img_url
 */

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