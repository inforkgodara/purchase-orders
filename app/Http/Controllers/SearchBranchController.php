<?php

namespace App\Http\Controllers;

use App\Branch;

class SearchBranchController extends Controller
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
            $elements = Branch::with('city')->where([
                ['branch', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['phone_number', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['email', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['building', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('city', function ($qry) use ($query) {
                $qry->where([
                    ['city', 'LIKE', '%' . $query . '%']
                ]);
            })
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'))->setPath('');
        } else {
            $elements = Branch::with('city')->where([
                ['branch', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['phone_number', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['email', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['building', 'LIKE', '%' . $query . '%']
            ])->orWhere([
                ['street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhereHas('city', function ($qry) use ($query) {
                $qry->where([
                    ['city', 'LIKE', '%' . $query . '%']
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
