<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "qr_codes".
 *
 * The followings are the available columns in table 'qr_codes':
 * @property string $id
 * @property string $name
 * @property string $thumbnail
 * @property string thumbnail_url
 * @property boolean is_default
 * */

class Language extends Model
{
    /**
     * @var string
     */
    protected $table = 'languages';
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = true;
}