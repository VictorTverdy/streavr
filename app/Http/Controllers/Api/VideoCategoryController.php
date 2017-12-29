<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\VideoCategory;
use App\Models\Backend\Language;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class VideoCategoryController extends Controller {
    /**
     * Show categories
     */
    public function getCategories() {
        $data = [];

        $languageId = Input::get('language_id');
        if ($languageId) {
            $sql = "SELECT vc.id, IFNULL(vcl.name, vc.name) name, IFNULL(vcl.description, vc.description) description, vc.thumbnail_url, vc.thumbnail, vc.slug"
                . " FROM video_categories as vc"
                . " LEFT JOIN video_category_languages as vcl ON vc.id = vcl.video_category_id and vcl.language_id =?";

            $categories = DB::select(
                DB::raw($sql,$languageId)
            );
        } else {
            $languages = Language::where('is_default', 0)->get();
            $categories = VideoCategory::orderBy('ordering', 'asc')
                ->get();
        }
        for ($i = 0; $i < count($categories); $i++) {
            $category = &$categories[$i];
            $category->DT_RowId = 'row_' . $category->id;
            $category->no = $i + 1;
            $category->DT_RowData = ['id' => $category->id];
            if ($category->thumbnail_url) {
                $category->thumbnail = '<img class="thumbnail" src="' . $category->thumbnail_url . '" />';
            }
            if (!$languageId) {
                $href = '';
                foreach ($languages as $language) {
                    $href .= '<a href="/video/category/language/' . $category->id . '?lang=' . $language->id . '" class="btn btn-xs blue "><i class="fa"></i>' . $language->id . '</a> ';
                }
                $category->language = $href;
            }
        }

        $data['data'] = $categories;

        return response()->json($data);
    }
}
