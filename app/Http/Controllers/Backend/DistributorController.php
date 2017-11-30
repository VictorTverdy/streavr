<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Distributor;
use App\Models\Backend\PaymentSource;
use App\Models\Backend\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class DistributorController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('backend.distributor.index');
    }

    /**
     * New event
     */
    public function newDistributor() {
        $sources = PaymentSource::get();

        return view('backend.distributor.new',[
            'sources' => $sources
        ]);
    }

    /**
     * Distributor event
     */
    public function editDistributor($id) {

        // Get event
        $distributor = Distributor::find($id);
        $sources = PaymentSource::get();

        return view('backend.distributor.edit', [
            'distributor' => $distributor,
            'sources' => $sources
        ]);
    }

    public function saveDistributor(Request $request)
    {

        $fields = [
            'name' => 'required',
            'email' => 'required'
        ];
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }


        $id = Input::get('id', 0);
        $name = Input::get('name');
        $email = Input::get('email');


        if ($id) {  // Update
            $distributor = Distributor::find($id);
            $source = PaymentSource::find($distributor->payment_source_id);
            $source->name = $name;
            $source->save();

        } else {    // New
            $source = new PaymentSource();
            $source->name = $name;
            $source->save();
            $distributor = new Distributor();
            $distributor->payment_source_id = $source->id;

        }

        $distributor->name = $name;
        $distributor->email = $email;
        $distributor->save();

        return redirect('/distributors');
    }

    /**
     * Delete distributor
     */
    public function deleteDistributor(Request $request, $id) {
        // Remove data in database
        $distributor = Distributor::find($id);
        $codes = QrCode::where([
            'payment_source_id' =>$distributor->payment_source_id
        ])->get()->count();

        if ($codes != 0 ) {
            $data = ['result' => 0];
        } else {
            Distributor::destroy($id);
            $data = ['result' => 1];
        }

        // result => 1: success, 0: error

        return response()->json($data);
    }

    /**
     * Get events list
     */
    public function getDistributors() {
        $data = [];

        $rows = Distributor::with('paymentSource')->orderBy('created_at', 'desc')->get();
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];
            $row->payment_source_name=$row->paymentSource->name;
            $row->created_at = date($row->created_at);
        }

        $data['data'] = $rows;

        return response()->json($data);
    }


}