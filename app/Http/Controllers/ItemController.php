<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Location;
use App\Branch;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
            ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
            ->join('item_units as um1', 'items.pack_unit_id', '=', 'um1.id')
            ->join('item_units as um2', 'items.standard_unit_id', '=', 'um2.id')
            ->select('items.*', 'item_groups.group', 'item_categories.category', 
            'um1.unit as pack_unit', 'um2.unit as standard_unit')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
        ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
        ->join('item_units as um1', 'items.pack_unit_id', '=', 'um1.id')
        ->join('item_units as um2', 'items.standard_unit_id', '=', 'um2.id')
        ->select('items.*', 'item_groups.group', 'item_categories.category', 
        'um1.unit as pack_unit', 'um2.unit as standard_unit')
        ->latest('items.id')->paginate(request('limit'));
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

        Item::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $items = new ResourceController();
        $collection = array();
        $collection['element'] = $item;
        $collection['dropdownData'] = $items->items();
        
        return $collection;
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return Location::where('branch_id', $branch->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $item->update(request()->all());

        return $response;
    }
}
