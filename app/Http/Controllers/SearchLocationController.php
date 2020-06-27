<?php

namespace App\Http\Controllers;

use App\Location;

class SearchLocationController extends Controller
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
            $elements = Location::join('branches', 'locations.branch_id', '=', 'branches.id')
            ->join('location_types', 'locations.location_type_id', '=', 'location_types.id')
            ->join('cities', 'locations.city_id', '=', 'cities.id')
            ->select('locations.*', 'branches.branch', 'location_types.type', 'cities.city')
            ->where([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['location_types.type', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['cities.city', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } else {
            $elements = Location::join('branches', 'locations.branch_id', '=', 'branches.id')
            ->join('location_types', 'locations.location_type_id', '=', 'location_types.id')
            ->join('cities', 'locations.city_id', '=', 'cities.id')
            ->select('locations.*', 'branches.branch', 'location_types.type', 'cities.city')
            ->where([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['location_types.type', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['locations.street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['cities.city', 'LIKE', '%' . $query . '%']
            ])
            ->latest('locations.id')->paginate(request('limit'));
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }
}
