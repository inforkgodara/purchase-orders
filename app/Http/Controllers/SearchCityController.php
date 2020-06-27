<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchCityController extends Controller
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
            $elements = City::with('province')->where([
                ['city', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('province', function ($qry) use ($query) {
                $qry->where([
                    ['province', 'LIKE', '%' . $query . '%']
                ]);
            })
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'))->setPath('');
        } else {
            $elements = City::with('province')->where([
                ['city', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('province', function ($qry) use ($query) {
                $qry->where([
                    ['province', 'LIKE', '%' . $query . '%']
                ]);
            })
            ->latest()->paginate(request('limit'))->setPath('');
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }
}
