<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province', 'country_id'
    ];

    public function country() {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
