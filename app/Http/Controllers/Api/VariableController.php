<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;


class VariableController extends Controller {

    /**
     * Show categories
     */
    public function getVariables(Request $request) {
        $fields = [
            'language_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $languageId = Input::get('language_id');

        $sql = "SELECT v.name , IFNULL(vl.description, v.description) description "
            . " FROM variables AS v "
            . " LEFT JOIN variable_languages vl  ON v.id = vl.variable_id and vl.language_id= :lang ";

        $rows = DB::select($sql, [
            'lang' => $languageId
        ]);

        return response()->json($rows);
    }
}