<?php

namespace App\Http\Controllers;

use App\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return ItemCategory::orderBy(request('column'), request('order'))
            ->paginate(request('limit'));    
        } 
        return ItemCategory::latest()
        ->paginate(request('limit'));
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

        ItemCategory::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemCategory  $item_category
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCategory $item_category)
    {
        return $item_category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCategory  $item_category
     * @return \Illuminate\Http\Response
     */
    public function update(ItemCategory $item_category)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $item_category->update(request()->all());

        return $response;
    }
}
