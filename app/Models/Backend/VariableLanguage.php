<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $language_id
 * @property string $variable_id
 * @property string $description
 */

class VariableLanguage extends Model {
    /**
     * @var string
     */
    protected $table = 'variable_languages';

    /**
     * @var bool
     */
    public $timestamps = true;


    public function variable()
    {
        return $this->hasOne('App\Models\Backend\Variable','id','variable_id');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Backend\Language','id','language_id');
    }
}