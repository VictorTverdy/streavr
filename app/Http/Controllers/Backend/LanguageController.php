<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::get();
        return view('backend.language.index',[
            'languages' => $languages
        ]);
    }

    /**
     * Edit language
     */
    public function editLanguage($id)
    {
        // Get language
        $language = Language::find($id);

        return view('backend.language.edit', [
            'language' => $language
        ]);
    }

    /**
     * Save video
     */
    public function saveLanguage(Request $request) {
        $user = Auth::user();

        $fields = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $fields);


        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $id = Input::get('id', 0);
        $languageClass = Language::find($id);
        $languageClass->updated_at = time();

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
                Storage::disk('s3')->put('language_thumbnails/'.$fileName, $img);
                $path = 'language_thumbnails/'.$fileName;
            } else {
                $path = Storage::disk('s3')->putFile('language_thumbnails', $request->file('thumbnail'), 'public');
            }

            $languageClass->thumbnail = $path;
            $url = Storage::disk('s3')->url($path);
            $languageClass->thumbnail_url = $url;
        }

        $languageClass->save();

        return redirect('/settings/languages');
    }
}