<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'location_type_id', 'name', 'building', 'street', 
        'city_id', 'inventory_account_id'
    ];
}
