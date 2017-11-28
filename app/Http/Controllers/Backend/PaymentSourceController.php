<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PaymentSource;

class PaymentSourceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sources = PaymentSource::get();
        return view('backend.payment-source.index',[
            'sources' =>$sources
        ]);
    }
}