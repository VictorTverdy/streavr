<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PaymentStatus;

class PaymentStatusController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statuses = PaymentStatus::get();
        return view('backend.payment-status.index',[
            'statuses' => $statuses
        ]);
    }
}