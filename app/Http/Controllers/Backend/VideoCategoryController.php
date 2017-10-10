<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;



class VideoCategoryController extends Controller {
    /**
     * Show categories
     */
    public function showCategories() {
        // Redirect if the user isn't admin
        $user = Auth::user();
        if ($user->user_level != 1)
            return redirect('/');

        return view('backend.video.category.index');
    }

    /**
     * Save category
     */
    public function saveCategory(Request $request)
    {
        // Redirect if the user isn't admin
        $user = Auth::user();
        if ($user->user_level != 1)
            return redirect('/');

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $categoryClass = VideoCategory::find($id);
        } else {    // New
            $categoryClass = new VideoCategory();
            $categoryClass->ordering = 9223372036854775807;
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
                Storage::disk('s3')->put('category_thumbnails/'.$fileName, $img);
                $path = 'category_thumbnails/'.$fileName;
            } else {
                $path = Storage::disk('s3')->putFile('category_thumbnails', $request->file('thumbnail'), 'public');
            }

            $categoryClass->thumbnail = $path;
            $url = Storage::disk('s3')->url($path);
            $categoryClass->thumbnail_url = $url;
        }

        $categoryClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $categoryClass->slug = str_slug($slug);
        $categoryClass->description = Input::get('description');
        $categoryClass->save();

        $categoryClass->updateOrder();

        return redirect('video/categories');
    }

    /**
     * Delete category
     * @param int $id The category id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCategory(Request $request, $id) {
        // Redirect if the user isn't admin
        $user = Auth::user();
        if ($user->user_level != 1)
            return redirect('/');

        if ($id != 1) {
            // Get data in database
            $category = VideoCategory::find($id);

            // Remove file
            if ($category->thumbnail) {
                Storage::disk('s3')->delete($category->thumbnail);
            }

            // Remove data in database
            VideoCategory::destroy($id);
        }

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Edit category
     */
    public function editCategory($id) {
        // Redirect if the user isn't admin
        $user = Auth::user();
        if ($user->user_level != 1)
            return redirect('/');

        $category = VideoCategory::find($id);

        return view('backend.video.category.edit', ['category' => $category]);
    }

    /**
     * Reorder category
     */
    public function reorderCategory() {
        // Redirect if the user isn't admin
        $user = Auth::user();
        if ($user->user_level != 1)
            return redirect('/');

        $categoryClass = new VideoCategory();
        $categoryClass->reOrder();

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }
}