<?php

namespace App\Http\Controllers;

use App\ItemUnit;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return ItemUnit::orderBy(request('column'), request('order'))
            ->paginate(request('limit'));    
        } 
        return ItemUnit::latest()
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

        ItemUnit::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemUnit  $item_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemUnit $item_unit)
    {
        return $item_unit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemUnit  $item_unit
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUnit $item_unit)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $item_unit->update(request()->all());

        return $response;
    }
}
