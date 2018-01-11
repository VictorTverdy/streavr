<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Distributor;
use App\Models\Backend\EmailTemplate;
use App\Models\Backend\Variable;
use App\Models\Backend\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Models\Backend\Attendee;
use phpDocumentor\Reflection\Types\Object_;
use Illuminate\Support\Facades\Crypt;
use App;
use Validator;
use Mail;
use  DNS2D;
use App\Models\Backend\Language;
use App\Models\Backend\VariableLanguage;

class VariableController extends Controller
{
    /**
     * Show all videos
     */
    public function showVariables()
    {
        return view('backend.variable.index');
    }

    /**
     * Get events list
     */
    public function getVariables() {
        $data = [];
        $languages =Language::where('is_default', 0)->get();

        $rows = Variable::orderBy('created_at', 'desc')->get();
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];
            $href = '';
            foreach ($languages as $language) {
                $href .= '<a href="/settings/variable/language/'.$row->id.'?lang='.$language->id.'" class="btn btn-xs blue "><i class="fa"></i>'. $language->id .'</a> ';
            }
            $row->language = $href;
        }
        $data['data'] = $rows;

        return response()->json($data);
    }

    /**
     * New event
     */
    public function newVariable() {
        return view('backend.variable.new');
    }

    /**
     * Edit variable
     */
    public function editVariable($id) {

        // Get event
        $variable = Variable::find($id);

        return view('backend.variable.edit', ['variable' => $variable]);
    }

    /**
     * Delete variable
     */
    public function deleteVariable(Request $request, $id) {
        // Remove data in database
        Variable::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Save variable
     */
    public function saveVariable(Request $request) {

        $id = Input::get('id', 0);

        if( $id ) {  // Update
            $variableClass = Variable::find($id);
            $variableClass->updated_at = time();
        } else {    // New
            $variableClass = new Variable();

        }

        $fields = [
            'name' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $variableClass->name = Input::get('name');
        $variableClass->description = Input::get('description');
        $variableClass->save();

        return redirect('settings/variables');
    }

    /**
     * Edit variable language
     */
    public function editVariableLanguage(Request $request, $id) {

        // Get variable
        $variable = Variable::find($id);

        $fields = [
            'lang' => 'required',
        ];
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $languageId = Input::get('lang');
        // Get language
        $language = Language::find($languageId);

        // Get variable language
        $variableLanguage = VariableLanguage::where([
            'variable_id' => $id,
            'language_id' => $languageId
        ])->first();

        return view('backend.variable.edit-language', [
            'variable' => $variable,
            'language' => $language,
            'variableLanguage' => $variableLanguage
        ]);
    }

    /**
     * Save variable language
     */
    public function saveVariableLanguage(Request $request) {

        $fields = [
            'language_id' => 'required',
            'variable_id' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $languageId = Input::get('language_id');
        $variableId = Input::get('variable_id');
        $description = Input::get('description');
        $id = Input::get('id');

        // create VariableLanguage
        if ($id) {
            $variableLanguage = VariableLanguage::find($id)->first();
        } else {
            $variableLanguage = new VariableLanguage();
        }

        $variableLanguage->language_id = $languageId;
        $variableLanguage->variable_id = $variableId;
        $variableLanguage->description = $description;

        if ($variableLanguage->save()) {
            return redirect('settings/variables');
        }

    }

}