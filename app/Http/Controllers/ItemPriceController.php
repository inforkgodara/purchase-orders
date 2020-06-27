<?php

namespace App\Http\Controllers;

use App\ItemPrice;
use Illuminate\Http\Request;

class ItemPriceController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return ItemPrice::join('items', 'item_prices.item_id', '=', 'items.id')
            ->join('item_categories', 'item_prices.item_category_id', '=', 'item_categories.id')
            ->join('item_groups', 'item_prices.item_group_id', '=', 'item_groups.id')
            ->select('item_prices.*', 'items.name', 'item_categories.category', 
            'item_groups.group')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return ItemPrice::join('items', 'item_prices.item_id', '=', 'items.id')
        ->join('item_categories', 'item_prices.item_category_id', '=', 'item_categories.id')
        ->join('item_groups', 'item_prices.item_group_id', '=', 'item_groups.id')
        ->select('item_prices.*', 'items.name', 'item_categories.category', 
        'item_groups.group')
        ->latest('item_prices.id')->paginate(request('limit'));  
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

        ItemPrice::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemPrice  $item_price
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPrice $item_price)
    {
        $data = ItemPrice::join('items', 'item_prices.item_id', '=', 'items.id')
            ->join('item_categories', 'item_prices.item_category_id', '=', 'item_categories.id')
            ->join('item_groups', 'item_prices.item_group_id', '=', 'item_groups.id')
            ->select('item_prices.*', 'items.name', 'item_categories.category', 
            'item_groups.group')
            ->where('item_prices.id', $item_price->id)->first();
        
        $item_prices = new ResourceController();
        $collection = array();
        $collection['element'] = $data;
        $collection['dropdownData'] = $item_prices->itemPrices();
        
        return $collection;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemPrice  $item_price
     * @return \Illuminate\Http\Response
     */
    public function update(ItemPrice $item_price)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $item_price->update(request()->all());

        return $response;
    }
}
