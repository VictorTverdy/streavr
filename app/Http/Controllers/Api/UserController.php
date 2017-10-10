<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;


class UserController extends Controller {
    /**
     * Sign up
     */
    public function signup() {
        $row = User::where('email', Input::get('email'))->first();
        if (!$row) {
            $userClass = new User();
            $userClass->password = Hash::make(Input::get('password'));
            $userClass->first_name = Input::get('first_name');
            $userClass->last_name = Input::get('last_name');
            // $userClass->username = Input::get('username');
            $userClass->email = Input::get('email');
            $userClass->user_level = 2;

            if ($userClass->save()) {
                $data = ['result' => 'success', 'data' => $userClass];
            } else {
                $data = ['result' => 'error'];
            }
        } else {
            $data = ['result' => 'exist_email'];
        }

        return response()->json($data);
    }

    /**
     * Login
     */
    public function login() {
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'enable' => 1])) {
            $data = [
                'result' => 'success',
                'data' => Auth::user()
            ];
        } else {
            $data = [
                'result' => 'failed'
            ];
        }

        return response()->json($data);
    }
}
