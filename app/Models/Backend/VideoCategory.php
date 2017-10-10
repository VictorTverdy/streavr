<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class VideoCategory extends Model {
    /**
     * @var string
     */
    protected $table = 'video_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Update order
     */
    public function updateOrder() {
        $rows = $this->orderBy('ordering', 'asc')->get();

        for($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $row->ordering = $i + 1;
            $row->save();
        }
    }

    /**
     * Reorder
     */
    public function reOrder() {
        $orders = Input::get('orders', []);

        for($i = 0; $i < count($orders); $i++) {
            $order = $orders[$i];
            $category = $this->find($order['id']);
            $category->ordering = $order['pos'] + 1;
            $category->save();
        }
    }
}