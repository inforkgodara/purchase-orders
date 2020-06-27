<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id','item_id', 'item_group_id', 'item_category_id', 'effective_from', 
        'purchase_price', 'landed_price', 'selling_price', 'remarks'
    ];
}
