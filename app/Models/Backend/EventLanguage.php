<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $language_id
 * @property string $event_id
 * @property string $name
 * @property string $title
 * @property string $subtitle
 * @property string $description
 */

class EventLanguage extends Model {
    /**
     * @var string
     */
    protected $table = 'event_languages';

    /**
     * @var bool
     */
    public $timestamps = true;



    public function event()
    {
        return $this->hasOne('App\Models\Backend\Event','id','event_id');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Backend\Language','id','language_id');
    }
}