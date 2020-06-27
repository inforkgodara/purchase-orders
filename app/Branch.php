<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id', 'branch', 'building', 'street',
        'phone_number', 'email'
    ];

    public function city() {
        return $this->belongsTo(City::class)->withDefault();
    }
}
