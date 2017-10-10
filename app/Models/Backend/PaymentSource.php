<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PaymentSource extends Model {
    /**
     * @var string
     */
    protected $table = 'payment_sources';

    /**
     * @var bool
     */
    public $timestamps = true;

}