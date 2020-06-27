<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartyCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'party_category_type_id', 'category'
    ];
}
