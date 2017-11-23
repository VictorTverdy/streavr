<?php
namespace App\Models\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

/**
 * This is the model class for table "video_favorites".
 *
 * The followings are the available columns in table 'video_favorites':
 * @property integer $id
 * @property integer $user_id
 * @property integer $video_id
 */

class VideoFavorites extends Model {
    /**
     * @var string
     */
    protected $table = 'video_favorites';

    /**
     * @var bool
     */
    public $timestamps = false;
}