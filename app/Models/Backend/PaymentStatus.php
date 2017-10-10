<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_statuses';

    /**
     * @var bool
     */
    public $timestamps = true;

}