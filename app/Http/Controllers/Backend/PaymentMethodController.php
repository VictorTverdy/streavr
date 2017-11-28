<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $methods = PaymentMethod::get();
        return view('backend.payment-method.index',[
            'methods' =>$methods
        ]);
    }
}