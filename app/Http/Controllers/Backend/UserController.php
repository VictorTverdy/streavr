<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller {
    /**
     * Show users
     */
    public function showUsers() {
        return view('backend.user.index');
    }

    /**
     * New user
     */
    public function newUser() {
        return view('backend.user.new');
    }

    /**
     * Save user
     */
    public function saveUser() {
        $id = Input::get('id', 0);
        $profile = Input::get('profile', 0);
        if( $id ) {  // Update
            $userClass = User::find($id);
            $userClass->updated_at = time();
            $userClass->enable = Input::get('enable');
            if (Input::get('password'))
                $userClass->password = Hash::make( Input::get('password') );
        } else {    // New
            $userClass = new User();
            $userClass->created_at = time();
            $userClass->updated_at = time();
            $userClass->password = Hash::make( Input::get('password') );
        }

        $userClass->first_name = Input::get('first_name');
        $userClass->last_name = Input::get('last_name');
        // $userClass->username = Input::get('username');
        $userClass->email = Input::get('email');
        $userClass->user_level = Input::get('role');
        $userClass->save();

        if ($profile)
            return redirect('user/profile');
        else
            return redirect('users');
    }

    /**
     * Get users
     */
    public function getUsers() {
        $data = [];

        $rows = User::orderBy('created_at', 'desc')
            ->get();
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];
            $row->name = $row->first_name .' '. $row->last_name;
            $row->enable = $row->enable ? '<span class="label label-sm label-success"> Enabled </span>' : '<span class="label label-sm label-danger"> Disabled </span>';
            $row->role = ($row->user_level == 1) ? ' Administrator ' : ' User ';
        }
        $data['data'] = $rows;

        return response()->json($data);
    }

    /**
     * Edit user
     */
    public function editUser($id) {
        // Get user
        $user = User::find($id);

        return view('backend.user.edit', ['user' => $user]);
    }

    /**
     * Delete user
     */
    public function deleteUser($id) {
        // Get data in database
        $obj = User::find($id);

        // Remove data in database
        User::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * User profile
     */
    public function userProfile() {
        $id = Auth::id();

        // Get user
        $user = User::find($id);

        return view('backend.user.profile', ['user' => $user]);
    }

}