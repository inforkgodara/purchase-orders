<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return Location::join('branches', 'locations.branch_id', '=', 'branches.id')
            ->join('location_types', 'locations.location_type_id', '=', 'location_types.id')
            ->join('cities', 'locations.city_id', '=', 'cities.id')
            ->select('locations.*', 'branches.branch', 'location_types.type', 'cities.city')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return Location::join('branches', 'locations.branch_id', '=', 'branches.id')
        ->join('location_types', 'locations.location_type_id', '=', 'location_types.id')
        ->join('cities', 'locations.city_id', '=', 'cities.id')
        ->select('locations.*', 'branches.branch', 'location_types.type', 'cities.city')
        ->latest('locations.id')->paginate(request('limit'));
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

        Location::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $locations = new ResourceController();
        $collection = array();
        $collection['element'] = $location;
        $collection['dropdownData'] = $locations->locations();
        
        return $collection;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Location $location)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $location->update(request()->all());

        return $response;
    }
}
