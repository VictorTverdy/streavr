<?php
namespace App\Models\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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