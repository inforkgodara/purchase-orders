<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 'country_id', 'city'
    ];

    public function province() {
        return $this->belongsTo(Province::class)->withDefault();
    }

    public function country() {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
