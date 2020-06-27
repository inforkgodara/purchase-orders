<?php

namespace App\Http\Controllers;

use App\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('column')) {
            return Debtor::join('branches', 'debtors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'debtors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'debtors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'debtors.city_id', '=', 'cities.id')
            ->select('debtors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } 
        return Debtor::join('branches', 'debtors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'debtors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'debtors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'debtors.city_id', '=', 'cities.id')
            ->select('debtors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->latest('debtors.id')->paginate(request('limit'));  
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

        Debtor::create($request->all());

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        $debtors = new ResourceController();
        $collection = array();
        $collection['element'] = $debtor;
        $collection['dropdownData'] = $debtors->debtors();
        
        return $collection;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Debtor $debtor)
    {
        $response = [
            'status' => 'pass',
            'message' => 'A record has been updated successfully.'
        ];

        $debtor->update(request()->all());

        return $response;
    }
}
