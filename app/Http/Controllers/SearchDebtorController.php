<?php

namespace App\Http\Controllers;

use App\Debtor;

class SearchDebtorController extends Controller
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
            $elements = Debtor::join('branches', 'debtors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'debtors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'debtors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'debtors.city_id', '=', 'cities.id')
            ->select('debtors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->where([
                ['debtors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.contact_number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.email', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['payment_terms.term', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['party_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['cities.city', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } else {
            $elements = Debtor::join('branches', 'debtors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'debtors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'debtors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'debtors.city_id', '=', 'cities.id')
            ->select('debtors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->where([
                ['debtors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.contact_number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.email', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['debtors.street', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['branches.branch', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['payment_terms.term', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['party_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['cities.city', 'LIKE', '%' . $query . '%']
            ])
            ->latest('debtors.id')->paginate(request('limit'));
        }
            
        $elements->appends(array(
            'keyword' => request('keyword'),
            'limit' => (int)request('limit')
        ));

        return $elements;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single()
    {
        $query = request('keyword');

        $elements = Debtor::where([
                ['name', 'LIKE', '%' . $query . '%']
            ])
            ->latest('id')->get();

        return $elements;
    }
}
