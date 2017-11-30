<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\EmailTemplate;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email()
    {
        $template = EmailTemplate::first();

        return view('backend.settings.email-template',[
            'template' => $template
        ]);
    }

    public function emailSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'body' => 'required',
            'from_name' => 'required',
            'from_email' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $nameFrom = Input::get('from_name');
        $emailFrom = Input::get('from_email');
        $subject = Input::get('subject');
        $body = Input::get('body');
        $id = Input::get('id');

        if ($id != "") {
            $template = EmailTemplate::where('id', $id)->first();
        } else {
            $template = new EmailTemplate();
        }

        $template->subject = $subject;
        $template->body = $body;
        $template->from_name = $nameFrom;
        $template->from_email = $emailFrom;
        $template->save();

        \Session::flash('flash_message','Office successfully added.'); //<--FLASH MESSAGE
        return redirect('/settings/email-template');

    }
}