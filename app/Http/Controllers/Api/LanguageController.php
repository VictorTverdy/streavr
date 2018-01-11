<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Language;

class LanguageController extends Controller {

    /**
     * Show categories
     */
    public function getLanguages() {
        $data = [];

        $languages = Language::get();

        return response()->json($languages);
    }
}