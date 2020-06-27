<?php

namespace App\Http\Controllers;

use App\Province;

class SearchProvinceController extends Controller
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
            $elements = Province::with('country')->where([
                ['province', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('country', function ($qry) use ($query) {
                $qry->where([
                    ['country', 'LIKE', '%' . $query . '%']
                ]);
            })
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'))->setPath('');
        } else {
            $elements = Province::with('country')->where([
                ['province', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('country', function ($qry) use ($query) {
                $qry->where([
                    ['country', 'LIKE', '%' . $query . '%']
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
