<?php

namespace App\Http\Controllers;

use App\Country;
use App\Province;
use App\City;
use App\Branch;
use App\Creditor;
use App\Debtor;
use App\PaymentTerm;
use App\PartyCategory;
use App\LocationType;
use App\ItemGroup;
use App\ItemCategory;
use App\ItemUnit;
use App\Item;
use App\Location;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries()
    {
        return Country::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function provinces()
    {
        $data = array();
        $data['provinces'] = Province::with('country')->latest()->get();
        $data['countries'] = Country::all();

        return $data; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities()
    {
        return City::all(); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creditors()
    {
        $data['branches'] = Branch::all();
        $data['payment_terms'] = PaymentTerm::all();
        $data['party_categories'] = PartyCategory::all();
        $data['cities'] = $this->cities();
        
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function debtors()
    {
        $data['branches'] = Branch::all();
        $data['payment_terms'] = PaymentTerm::all();
        $data['party_categories'] = PartyCategory::all();
        $data['cities'] = $this->cities();
        
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function locations()
    {
        $data['branches'] = Branch::all();
        $data['location_types'] = LocationType::all();
        $data['cities'] = $this->cities();
        
        return $data;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function items()
    {
        $data['item_groups'] = ItemGroup::all();
        $data['item_categories'] = ItemCategory::all();
        $data['units'] = ItemUnit::all();
        
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item_prices()
    {
        $data['branches'] = Branch::all();
        
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchase_orders()
    {
        $data['branches'] = Branch::all();
        $data['locations'] = Location::all();
        
        return $data;
    }
}
