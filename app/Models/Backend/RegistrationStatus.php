<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class RegistrationStatus extends Model {
    /**
     * @var string
     */
    protected $table = 'registration_statuses';

    /**
     * @var bool
     */
    public $timestamps = true;

}