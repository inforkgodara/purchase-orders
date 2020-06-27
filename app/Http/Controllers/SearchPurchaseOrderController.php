<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;

class SearchPurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = request('keyword');

        if(request('column')) {
            $elements = PurchaseOrder::join('branches', 'purchase_orders.branch_id', '=', 'branches.id')
            ->join('creditors', 'purchase_orders.creditor_id', '=', 'creditors.id')
            ->join('locations', 'purchase_orders.location_id', '=', 'locations.id')
            ->leftJoin('debtors', 'purchase_orders.debtor_id', '=', 'debtors.id')
            ->select('purchase_orders.*', 'branches.branch', 'creditors.name as creditor_name', 
            'locations.name as location_name', 'debtors.name as debtor_name')
            ->where([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['purchase_orders.number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['purchase_orders.date', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } else {
            $elements = PurchaseOrder::join('branches', 'purchase_orders.branch_id', '=', 'branches.id')
            ->join('creditors', 'purchase_orders.creditor_id', '=', 'creditors.id')
            ->join('locations', 'purchase_orders.location_id', '=', 'locations.id')
            ->leftJoin('debtors', 'purchase_orders.debtor_id', '=', 'debtors.id')
            ->select('purchase_orders.*', 'branches.branch', 'creditors.name as creditor_name', 
            'locations.name as location_name', 'debtors.name as debtor_name')
            ->where([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['purchase_orders.number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['purchase_orders.date', 'LIKE', '%' . $query . '%']
            ])
            ->latest('purchase_orders.id')->paginate(request('limit'));
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }
}
