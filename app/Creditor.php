<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
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

    // public function branch() {
    //     return $this->belongsTo(Branch::class)->withDefault();
    // }

    // public function paymentTerm() {
    //     return $this->belongsTo(PaymentTerm::class)->withDefault();
    // }

    // public function partyCategory() {
    //     return $this->belongsTo(PartyCategory::class)->withDefault();
    // }

    // public function city() {
    //     return $this->belongsTo(City::class)->withDefault();
    // }
}
