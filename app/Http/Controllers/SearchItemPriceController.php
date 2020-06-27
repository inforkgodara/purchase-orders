<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemPrice;
use App\Item;

class SearchItemPriceController extends Controller
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
            $elements = ItemPrice::join('items', 'item_prices.item_id', '=', 'items.id')
            ->join('item_categories', 'item_prices.item_category_id', '=', 'item_categories.id')
            ->join('item_groups', 'item_prices.item_group_id', '=', 'item_groups.id')
            ->select('item_prices.*', 'items.name', 'item_categories.category', 
            'item_groups.group')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_groups.group', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        } else {
            $elements = ItemPrice::join('items', 'item_prices.item_id', '=', 'items.id')
            ->join('item_categories', 'item_prices.item_category_id', '=', 'item_categories.id')
            ->join('item_groups', 'item_prices.item_group_id', '=', 'item_groups.id')
            ->select('item_prices.*', 'items.name', 'item_categories.category', 
            'item_groups.group')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_groups.group', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['item_categories.category', 'LIKE', '%' . $query . '%']
            ])
            ->latest('items.id')->paginate(request('limit'));
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

        $elements = Item::join('item_groups', 'items.item_group_id', '=', 'item_groups.id')
        ->join('item_categories', 'items.item_category_id', '=', 'item_categories.id')
        ->select('items.*', 'item_groups.group', 'item_categories.category')
            ->where([
                ['items.name', 'LIKE', '%' . $query . '%']
            ])
            ->orWhere([
                ['items.bar_code', 'LIKE', '%' . $query . '%']
            ])
            ->latest('items.id')->get();

        return $elements;
    }
}
