<?php

namespace App\Http\Controllers;

use App\Creditor;
use Illuminate\Http\Request;

class CreditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return Creditor::join('branches', 'creditors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'creditors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'creditors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'creditors.city_id', '=', 'cities.id')
            ->select('creditors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return Creditor::join('branches', 'creditors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'creditors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'creditors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'creditors.city_id', '=', 'cities.id')
            ->select('creditors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->latest('creditors.id')->paginate(request('limit'));  
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

        Creditor::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function edit(Creditor $creditor)
    {
        $creditors = new ResourceController();
        $collection = array();
        $collection['element'] = $creditor;
        $collection['dropdownData'] = $creditors->creditors();
        
        return $collection;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function update(Creditor $creditor)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $creditor->update(request()->all());

        return $response;
    }
}
