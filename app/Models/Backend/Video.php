<?php
namespace App\Models\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\S3;

/**
 * This is the model class for table "videos".
 *
 * The followings are the available columns in table 'videos':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property integer $category_id
 * @property string $video_name
 * @property integer $video_size
 * @property string $thumbnail
 * @property string $thumbnail_url
 * @property string $video
 * @property string $video_url
 * @property integer $ordering
 * @property string $complited_date
 * @property integer $visibility
 */

class Video extends Model {
    /**
     * @var string
     */
    protected $table = 'videos';

    public function upload(Request $request) {
        $file_data = [];

        // Upload video to S3
        if ($request->file('video')) {
            $s3 = new S3(env('AWS_KEY'), env('AWS_SECRET'));
            $bucketName = env('AWS_BUCKET');
            $file_name = md5($request->file('video')->getClientOriginalName(). time()) . '.' . $request->file('video')->getClientOriginalExtension();
            $path = 'videos/' . $file_name;
            $uploadFile = $_FILES['video']['tmp_name'];
            if ($s3->putObjectFile($uploadFile, $bucketName, $path, S3::ACL_PUBLIC_READ)) {
                $url = Storage::disk('s3')->url($path);
                $file_data['name'] = $request->file('video')->getClientOriginalName();
                $file_data['size'] = $request->file('video')->getClientSize();
                $file_data['type'] = $request->file('video')->getClientMimeType();
                $file_data['url'] = $url;
                $file_data['path'] = $path;
                $file_data['deleteType'] = 'GET';
                $file_data['deleteUrl'] = url('/video/delete_video?path='. $path);
            }
        }

        /*
        if ($request->file('video')) {
            // $path = Storage::disk('s3')->putFile('videos', $request->file('video'), 'public');     // for small file

            $file_name = md5($request->file('video')->getClientOriginalName(). time()) . '.' . $request->file('video')->getClientOriginalExtension();
            Storage::disk('s3')->put('videos/' . $file_name, fopen($_FILES['video']['tmp_name'], 'r+'), 'public');    // for large file

            $path = 'videos/' . $file_name;
            $url = Storage::disk('s3')->url($path);
            $file_data['name'] = $request->file('video')->getClientOriginalName();
            $file_data['size'] = $request->file('video')->getClientSize();
            $file_data['type'] = $request->file('video')->getClientMimeType();
            $file_data['url'] = $url;
            $file_data['path'] = $path;
            $file_data['deleteType'] = 'GET';
            $file_data['deleteUrl'] = url('/video/delete_video?path='. $path);
        }
        */

        return $file_data;
    }
}