<?php

namespace App\Http\Controllers;

use App\Creditor;

class SearchCreditorController extends Controller
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
            $elements = Creditor::join('branches', 'creditors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'creditors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'creditors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'creditors.city_id', '=', 'cities.id')
            ->select('creditors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->where([
                ['creditors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.contact_number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.email', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.street', 'LIKE', '%' . $query . '%']
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
            $elements = Creditor::join('branches', 'creditors.branch_id', '=', 'branches.id')
            ->join('payment_terms', 'creditors.payment_term_id', '=', 'payment_terms.id')
            ->join('party_categories', 'creditors.party_category_id', '=', 'party_categories.id')
            ->join('cities', 'creditors.city_id', '=', 'cities.id')
            ->select('creditors.*', 'branches.branch', 'payment_terms.term', 'party_categories.category', 'cities.city')
            ->where([
                ['creditors.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.contact_number', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.email', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.building', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['creditors.street', 'LIKE', '%' . $query . '%']
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
            ->latest('creditors.id')->paginate(request('limit'));
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

        $elements = Creditor::where([
                ['name', 'LIKE', '%' . $query . '%']
            ])
            ->latest('id')->get();

        return $elements;
    }
}
