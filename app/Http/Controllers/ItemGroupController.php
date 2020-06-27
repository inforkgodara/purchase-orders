<?php

namespace App\Http\Controllers;

use App\ItemGroup;
use Illuminate\Http\Request;

class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return ItemGroup::orderBy(request('column'), request('order'))
            ->paginate(request('limit'));    
        } 
        return ItemGroup::latest()
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

        ItemGroup::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemGroup  $item_group
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemGroup $item_group)
    {
        return $item_group;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemGroup  $item_group
     * @return \Illuminate\Http\Response
     */
    public function update(ItemGroup $item_group)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $item_group->update(request()->all());

        return $response;
    }
}
