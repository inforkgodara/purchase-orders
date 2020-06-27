<?php

namespace App\Http\Controllers;

use App\Currency;

class SearchCurrencyController extends Controller
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
            $elements = Currency::where([
                ['currency', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'))->setPath('');
        } else {
            $elements = Currency::where([
                ['currency', 'LIKE', '%' . $query . '%']
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
