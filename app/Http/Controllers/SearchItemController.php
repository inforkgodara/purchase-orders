<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class SearchItemController extends Controller
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
            $elements = Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
            ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
            ->join('item_units as um1', 'items.pack_unit_id', '=', 'um1.id')
            ->join('item_units as um2', 'items.standard_unit_id', '=', 'um2.id')
            ->select('items.*', 'item_groups.group', 'item_categories.category', 
            'um1.unit as pack_unit', 'um2.unit as standard_unit')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_groups.group', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['um1.unit', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.pack_size', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } else {
            $elements = Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
            ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
            ->join('item_units as um1', 'items.pack_unit_id', '=', 'um1.id')
            ->join('item_units as um2', 'items.standard_unit_id', '=', 'um2.id')
            ->select('items.*', 'item_groups.group', 'item_categories.category', 
            'um1.unit as pack_unit', 'um2.unit as standard_unit')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_groups.group', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['um1.unit', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['um2.unit', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.pack_size', 'LIKE', '%' . $query . '%']
            ])
            ->latest('items.id')->paginate(request('limit'));
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single()
    {
        $query = request('keyword');

        $elements = Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
        ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
        ->select('items.*', 'item_groups.group', 'item_categories.category')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->latest('items.id')->get();
        return $elements;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function po_single()
    {
        $query = request('keyword');

        // $elements = Item::join('item_prices', 'items.id', '=', 'item_prices.item_id')
        // ->join('item_units as um1', 'items.pack_unit_id', '=', 'um1.id')
        // ->join('item_units as um2', 'items.standard_unit_id', '=', 'um2.id')    
        // ->select('items.*', 'um1.unit as pack_unit', 'um2.unit as standard_unit', 'item_prices.purchase_price')
        //     ->where([
        //         ['items.name', 'LIKE', '%' . $query . '%']
        //     ])
        //     ->orWhere([
        //         ['items.bar_code', 'LIKE', '%' . $query . '%']
        //     ])
        //     // ->groupBy('items.name')
        //     ->latest('items.id')->get();
        
        // return $elements;
        return Item::all();
    }
}
