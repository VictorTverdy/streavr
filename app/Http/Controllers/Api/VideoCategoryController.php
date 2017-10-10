<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\VideoCategory;

class VideoCategoryController extends Controller {
    /**
     * Show categories
     */
    public function getCategories() {
        $data = [];

        $categories = VideoCategory::orderBy('ordering', 'asc')
                        ->get();
        for ($i = 0; $i < count($categories); $i++) {
            $category = &$categories[$i];
            $category->DT_RowId = 'row_' . $category->id;
            $category->no = $i + 1;
            $category->DT_RowData = ['id' => $category->id];
            if ($category->thumbnail_url) {
                $category->thumbnail = '<img class="thumbnail" src="'. $category->thumbnail_url .'" />';
            }
        }
        $data['data'] = $categories;

        return response()->json($data);
    }
}
