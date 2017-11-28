<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Distributor;
use App\Models\Backend\PaymentSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

        $id = Input::get('id', 0);
        $name = Input::get('name');
        $email = Input::get('email');
        $sourceId = Input::get('source_id');

        if ($id) {  // Update
            $distributor = Distributor::find($id);
        } else {    // New
            $distributor = new Distributor();
        }

        $distributor->name = $name;
        $distributor->email = $email;
        $distributor->payment_source_id = $sourceId;
        $distributor->save();

        return redirect('/distributors');
    }

    /**
     * Delete distributor
     */
    public function deleteDistributor(Request $request, $id) {
        // Remove data in database
        Distributor::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

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