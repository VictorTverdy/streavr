<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model {
    /**
     * @var string
     */
    protected $table = 'users';

}