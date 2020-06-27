<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return PurchaseOrder::join('branches', 'purchase_orders.branch_id', '=', 'branches.id')
            ->join('creditors', 'purchase_orders.creditor_id', '=', 'creditors.id')
            ->join('locations', 'purchase_orders.location_id', '=', 'locations.id')
            ->leftJoin('debtors', 'purchase_orders.debtor_id', '=', 'debtors.id')
            ->select('purchase_orders.*', 'branches.branch', 'creditors.name as creditor_name', 
            'locations.name as location_name', 'debtors.name as debtor_name')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return PurchaseOrder::join('branches', 'purchase_orders.branch_id', '=', 'branches.id')
        ->join('creditors', 'purchase_orders.creditor_id', '=', 'creditors.id')
        ->join('locations', 'purchase_orders.location_id', '=', 'locations.id')
        ->leftJoin('debtors', 'purchase_orders.debtor_id', '=', 'debtors.id')
        ->select('purchase_orders.*', 'branches.branch', 'creditors.name as creditor_name', 
        'locations.name as location_name', 'debtors.name as debtor_name')
        ->latest('purchase_orders.id')->paginate(request('limit')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A new record has been created successfully.'
        ];

        $purchaseOrder = PurchaseOrder::create($request->except('details'));

        $purchaseOrder->purchaseOrderDetails()->createMany($request->details);

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchase_order)
    {
        $purchase_orders = new ResourceController();
        $collection = array();
        $collection['element'] = $purchase_order;
        $collection['dropdownData'] = $purchase_orders->purchase_orders();
        $collection['creditor'] = $purchase_order->creditor;
        $collection['debtor'] = $purchase_order->debtor;

        return $collection;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseOrder $purchase_order)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $purchase_order->update(request()->all());

        return $response;
    }
}
