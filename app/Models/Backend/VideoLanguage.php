<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $language_id
 * @property string $video_id
 * @property string $name
 * @property string $description
 */

class VideoLanguage extends Model {
    /**
     * @var string
     */
    protected $table = 'video_languages';

    /**
     * @var bool
     */
    public $timestamps = true;


    public function video()
    {
        return $this->hasOne('App\Models\Backend\Video','id','video_id');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Backend\Language','id','language_id');
    }
}