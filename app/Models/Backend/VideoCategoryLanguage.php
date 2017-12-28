<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $language_id
 * @property string $video_category_id
 * @property string $name
 * @property string $description
 */

class VideoCategoryLanguage extends Model {
    /**
     * @var string
     */
    protected $table = 'video_category_languages';

    /**
     * @var bool
     */
    public $timestamps = true;


    public function videoCategory()
    {
        return $this->hasOne('App\Models\Backend\VideoCategory','id','video_category_id');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Backend\Language','id','language_id');
    }
}