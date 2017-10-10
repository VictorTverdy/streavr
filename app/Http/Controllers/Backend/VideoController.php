<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use Validator;

class VideoController extends Controller {
    /**
     * Show all videos
     */
    public function showVideos() {
        $user = Auth::user();

        if ($user->user_level == 1)
            return view('backend.video.index_admin');
        else
            return view('backend.video.index');
    }

    /**
     * New video
     */
    public function newVideo() {
        // Get video categories
        $categories = DB::table('video_categories')->orderBy('ordering', 'asc')->get();

        return view('backend.video.new', ['categories' => $categories]);
    }

    /**
     * Edit video
     */
    public function editVideo($id) {
        // Get video categories
        $categories = DB::table('video_categories')->orderBy('ordering', 'asc')->get();

        // Get video
        $video = Video::find($id);

        return view('backend.video.edit', ['categories' => $categories, 'video' => $video]);
    }

    /**
     * Upload video
     */
    public function uploadVideo(Request $request) {
        set_time_limit(7200);

        $files = [ 'files' => [] ];

        $videoObj = new Video();
        $file = $videoObj->upload($request);
        if ($file)
            $files['files'][] = $file;

        return response()->json($files);
    }

    /**
     * Delete video file
     */
    public function deleteVideoFile(Request $request) {
        $path = $request->input('path');

        // Remove file
        if ($path) {
            Storage::disk('s3')->delete($path);
        }

        $data = [ 'result' => 1 ];
        return response()->json($data);
    }

    /**
     * Save video
     */
    public function saveVideo(Request $request) {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'video_path' => 'required',
            'video_name' => 'required',
            'video_size' => 'required',
            'thumbnail' => 'required',
       ]);


        if ($validator->fails()) {
           return $validator->errors()->all();
        }

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $videoClass = Video::find($id);
            $videoClass->updated_at = time();

        } else {    // New
            $videoClass = new Video();
            $videoClass->ordering = 9223372036854775807;
            $videoClass->created_at = time();
            $videoClass->updated_at = time();
        }

        // Save thumbnail
        if ($request->file('thumbnail')) {

            $img = new Image();
            $img->make($request->file('thumbnail')->path());
            $img = $img->make($request->file('thumbnail')->path());
            $maxLength = 1000;
            $imageWidth = $img->width();
            $imageHeight = $img->height();
            $ext = $request->file('thumbnail')->extension();

            if (($imageHeight>$maxLength) || ($imageWidth>$maxLength)) {
                if ($imageWidth >= $imageHeight) {
                    $koef = $imageWidth / $maxLength;
                    $newHeight = ceil($imageHeight / $koef);
                    $newWidth = $maxLength;
                } else {
                    $koef = $imageHeight / $maxLength;
                    $newWidth = ceil($imageWidth / $koef);
                    $newHeight = $maxLength;
                }
                $img = $img->resize($newWidth, $newHeight)->encode($ext);
                $img = $img->__toString();
                $fileName = md5($request->file('thumbnail')->getClientOriginalName()).'.'.$ext;
                Storage::disk('s3')->put('video_thumbnails/'.$fileName, $img);
                $path = 'video_thumbnails/'.$fileName;
            } else {
                $path = Storage::disk('s3')->putFile('video_thumbnails', $request->file('thumbnail'), 'public');
            }

            $videoClass->thumbnail = $path;
            $url = Storage::disk('s3')->url($path);
            $videoClass->thumbnail_url = $url;
        }

        $videoClass->title = Input::get('name');
        $videoClass->description = Input::get('description');
        $videoClass->user_id = $user->id;
        /*
        if ($videoClass->user_level == 1)
        else
            $videoClass->category_id = 1;
        */
        $videoClass->category_id = Input::get('category');
        $videoClass->video_name = Input::get('video_name');
        $videoClass->video_size = Input::get('video_size');
        $videoClass->video = Input::get('video_path');
        $videoClass->video_url = Storage::disk('s3')->url($videoClass->video);;
        $videoClass->visibility = Input::get('visibility');
        $videoClass->save();

        return redirect('videos');
    }

    /**
     * Delete video
     */
    public function deleteVideo(Request $request, $id) {
        // Get data in database
        $obj = Video::find($id);

        // Remove file
        if ($obj->thumbnail) {
            Storage::disk('s3')->delete($obj->thumbnail);
        }
        if ($obj->video) {
            Storage::disk('s3')->delete($obj->video);
        }

        // Remove data in database
        Video::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Get videos by user
     */
    public function getVideosByUser() {
        $data = [];

        $user = Auth::user();

        if ($user->user_level == 1) {     // Administrator
            $sql = "SELECT v.*, c.name category_name, u.email user_email, CONCAT(u.first_name, ' ', u.last_name) AS user_name"
                . " FROM videos AS v"
                . " LEFT JOIN video_categories AS c ON c.id = v.category_id"
                . " LEFT JOIN users AS u ON u.id = v.user_id"
                . " ORDER BY v.created_at DESC";
            $rows = DB::select($sql);
        } else {
            $rows = Video::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];
            if ($row->thumbnail_url) {
                $row->thumbnail = '<img class="thumbnail" src="'. $row->thumbnail_url .'" />';
            }
            $row->visibility = $row->visibility ? '<span class="label label-sm label-success"> Show </span>' : '<span class="label label-sm label-danger"> Hidden </span>';
        }
        $data['data'] = $rows;

        return response()->json($data);
    }
}
