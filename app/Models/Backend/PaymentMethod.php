<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_methods';

    /**
     * @var bool
     */
    public $timestamps = true;

}