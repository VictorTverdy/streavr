<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\EmailTemplate;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email()
    {
        $template = EmailTemplate::get();
        return view('backend.settings.email-template',[
            'template' => $template
        ]);
    }
}