<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'name', 'credit_days', 'credit_limit', 'payment_term_id', 'party_category_id',
        'building', 'street', 'city_id', 'contact_number', 'email', 'control_account_id',
    ];
}
