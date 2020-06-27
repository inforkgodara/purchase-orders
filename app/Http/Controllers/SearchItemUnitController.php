<?php

namespace App\Http\Controllers;

use App\ItemUnit;

class SearchItemUnitController extends Controller
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
            $elements = ItemUnit::where([
                ['unit', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'))->setPath('');
        } else {
            $elements = ItemUnit::where([
                ['unit', 'LIKE', '%' . $query . '%']
            ])
            ->latest()->paginate(request('limit'))->setPath('');
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }
}
