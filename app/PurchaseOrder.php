<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'creditor_id', 'location_id', 'debtor_id', 'number', 'date', 
        'reference', 'total_quantity', 'total_amount', 'remarks'
    ];

    public function purchaseOrderDetails() {
        return $this->hasMany(PurchaseOrderDetail::class);   
    }

    public function creditor() {
        return $this->belongsTo(Creditor::class)->withDefault();   
    }

    public function debtor() {
        return $this->belongsTo(Debtor::class)->withDefault();   
    }
}
