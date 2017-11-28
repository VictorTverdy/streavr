<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\RegistrationStatus;

class RegistrationStatusController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statuses = RegistrationStatus::get();
        return view('backend.registration-status.index',[
            'statuses' => $statuses
        ]);
    }
}