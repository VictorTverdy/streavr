<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Video;
use App\Models\Backend\VideoFavorites;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class VideoController extends Controller {
    /**
     * Uploaded video
     */
    public function uploadedVideo($id) {
        $files = [ 'files' => [] ];

        $video = Video::find($id);
        if ($video) {
            $file = [];
            $file['name'] = $video->video_name;
            $file['size'] = $video->video_size;
            $file['url'] = $video->video_url;
            $file['path'] = $video->video;
            $file['deleteType'] = 'GET';
            $file['deleteUrl'] = url('/video/delete_video?path='. $file['path']);

            $files['files'][] = $file;
        }

        return response()->json($files);
    }

    /**
     * Get videos by category and user
     */
    public function getVideosByCategoryAndUser(Request $request) {

        $fields = [
            'category_id' => 'required',
            'user_id' => 'required',
            'language_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $category_id = Input::get('category_id');
        $user_id = Input::get('user_id');
        $languageId = Input::get('language_id');

        $sql = "SELECT v.id, IFNULL(vl.title, v.title) title, IFNULL(vl.description, v.description) description, "
            ." v.user_id, v.category_id, v.video_name, v.video_size, v.thumbnail, v.thumbnail_url, v.video, v.video_url, "
            ." v.ordering, v.completed_date, v.created_at, v.updated_at, v.visibility, "
            ." (SELECT COUNT(f.id) FROM video_favorites AS f WHERE f.user_id = :user_id AND f.video_id = v.id) AS favorite"
            . " FROM videos AS v"
            . " LEFT JOIN video_categories AS c ON c.id = v.category_id"
            . " LEFT JOIN video_languages vl  ON v.id = vl.video_id and vl.language_id= :lang "
            . " WHERE v.visibility=1 AND v.category_id = :category_id";
        $rows = DB::select($sql, [
            'user_id' => $user_id,
            'category_id' => $category_id,
            'lang' => $languageId
        ]);

        return response()->json($rows);
    }

    /**
     * Get user's favorite videos
     */
    public function getFavoriteVideos() {
        $category_id = Input::get('category_id');
        $user_id = Input::get('user_id');

        $sql = "SELECT v.*"
            . " FROM videos AS v"
            . " LEFT JOIN video_categories AS c ON c.id = v.category_id"
            . " WHERE v.visibility=1 AND v.category_id = ? AND v.id IN (SELECT video_id FROM video_favorites WHERE user_id = ?)";
        $rows = DB::select($sql, [$category_id, $user_id]);

        return response()->json($rows);
    }

    /**
     * Get video by id
     */
    public function getVideo() {
        $video_id = Input::get('video_id');
        $user_id = Input::get('user_id');

        $video = Video::find($video_id);

        // Get favorite
        $favorite = VideoFavorites::where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->first();

        if ($favorite)
            $video->favorite = 1;
        else
            $video->favorite = 0;

        return response()->json($video);
    }

    /**
     * Add favorite to video
     */
    public function addFavorite() {
        $video_id = Input::get('video_id');
        $user_id = Input::get('user_id');

        $favorite = VideoFavorites::where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->first();
        if ($favorite) {
            $data = ['result' => 'already_exist'];
        } else {
            $favorite = new VideoFavorites();
            $favorite->video_id = $video_id;
            $favorite->user_id = $user_id;
            if ($favorite->save())
                $data = ['result' => 'success'];
            else
                $data = ['result' => 'error'];
        }

        return response()->json($data);
    }

    /**
     * Remove favorite
     */
    public function removeFavorite() {
        $video_id = Input::get('video_id');
        $user_id = Input::get('user_id');

        $favorite = VideoFavorites::where('video_id', $video_id)
            ->where('user_id', $user_id)
            ->delete();

        if ($favorite)
            $data = ['result' => 'success'];
        else
            $data = ['result' => 'error'];

        return response()->json($data);
    }
}
