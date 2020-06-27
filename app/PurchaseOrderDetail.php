<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_order_id', 'item_id', 'item_unit_id', 'quantity', 'rate', 'amount'
    ];

    public function item() {
        return $this->belongsTo(Item::class)->withDefault();   
    }

    public function itemUnit() {
        return $this->belongsTo(ItemUnit::class)->withDefault();   
    }
}
