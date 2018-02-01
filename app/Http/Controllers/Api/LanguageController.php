<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Language;

class LanguageController extends Controller {

    /**
     * get languages
     */
    public function getLanguages() {
        $sql = "SELECT l.*, d.name as direction_name"
            . " FROM languages as l"
            . " INNER JOIN directions as d ON l.direction_id =  d.id ";
        $query =DB::raw($sql);
        $languages = DB::select($query);

        return response()->json($languages);
    }
}