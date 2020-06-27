<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

   // Authentication Routes...
   Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
   Route::post('login', 'Auth\LoginController@login');
   Route::post('logout', 'Auth\LoginController@logout')->name('logout');
   
   // Password Reset Routes...
   Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.update');
   Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
   Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
   Route::post('password/reset', 'Auth\ResetPasswordController@reset');

   // Route::get('/password/change','Auth\ChangePasswordController@edit');
   // Route::post('/password/change','Auth\ChangePasswordController@update');

   // Route::get('/profile/update','Auth\UpdateProfileController@edit');
   // Route::post('/profile/update','Auth\UpdateProfileController@update');
   
   Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    
    Route::get('/countries', 'CountryController@index');
    Route::get('/countries/{country}/edit', 'CountryController@edit');
    Route::post('/countries', 'CountryController@store');
    Route::post('/countries/{country}', 'CountryController@update');
    Route::any('/search-countries/{keyword?}{column?}{order?}{limit?}', 'SearchCountryController@index');

    Route::get('/provinces', 'ProvinceController@index');
    Route::get('/provinces/{province}/edit', 'ProvinceController@edit');
    Route::post('/provinces', 'ProvinceController@store');
    Route::post('/provinces/{province}', 'ProvinceController@update');
    Route::any('/search-provinces/{keyword?}{column?}{order?}{limit?}', 'SearchProvinceController@index');

    Route::get('/cities', 'CityController@index');
    Route::get('/cities/{city}/edit', 'CityController@edit');
    Route::post('/cities', 'CityController@store');
    Route::post('/cities/{city}', 'CityController@update');
    Route::any('/search-cities/{keyword?}{column?}{order?}{limit?}', 'SearchCityController@index');
   
    Route::any('/resource-countries/{keyword?}', 'ResourceController@countries');
    Route::any('/resource-provinces/{keyword?}', 'ResourceController@provinces');
    Route::any('/resource-cities', 'ResourceController@cities');
    Route::any('/resource-creditors', 'ResourceController@creditors');
    Route::any('/resource-debtors', 'ResourceController@debtors');
    Route::any('/resource-locations', 'ResourceController@locations');
    Route::any('/resource-items', 'ResourceController@items');
    Route::any('/resource-item-prices', 'ResourceController@item_prices');
    Route::any('/resource-purchase-orders', 'ResourceController@purchase_orders');

    Route::get('/branches', 'BranchController@index');
    Route::get('/branches/{branch}/edit', 'BranchController@edit');
    Route::post('/branches', 'BranchController@store');
    Route::post('/branches/{branch}', 'BranchController@update');
    Route::any('/search-branches/{keyword?}{column?}{order?}{limit?}', 'SearchBranchController@index');

    Route::get('/creditors', 'CreditorController@index');
    Route::get('/creditors/{creditor}/edit', 'CreditorController@edit');
    Route::post('/creditors', 'CreditorController@store');
    Route::post('/creditors/{creditor}', 'CreditorController@update');
    Route::any('/search-creditors/{keyword?}{column?}{order?}{limit?}', 'SearchCreditorController@index');

    Route::get('/debtors', 'DebtorController@index');
    Route::get('/debtors/{debtor}/edit', 'DebtorController@edit');
    Route::post('/debtors', 'DebtorController@store');
    Route::post('/debtors/{debtor}', 'DebtorController@update');
    Route::any('/search-debtors/{keyword?}{column?}{order?}{limit?}', 'SearchDebtorController@index');

    Route::get('/locations', 'LocationController@index');
    Route::get('/locations/{location}/edit', 'LocationController@edit');
    Route::post('/locations', 'LocationController@store');
    Route::post('/locations/{location}', 'LocationController@update');
    Route::any('/search-locations/{keyword?}{column?}{order?}{limit?}', 'SearchLocationController@index'); 
   
    Route::get('/item-categories', 'ItemCategoryController@index');
    Route::get('/item-categories/{item_category}/edit', 'ItemCategoryController@edit');
    Route::post('/item-categories', 'ItemCategoryController@store');
    Route::post('/item-categories/{item_category}', 'ItemCategoryController@update');
    Route::any('/search-item-categories/{keyword?}{column?}{order?}{limit?}', 'SearchItemCategoryController@index');

    Route::get('/item-groups', 'ItemGroupController@index');
    Route::get('/item-groups/{item_group}/edit', 'ItemGroupController@edit');
    Route::post('/item-groups', 'ItemGroupController@store');
    Route::post('/item-groups/{item_group}', 'ItemGroupController@update');
    Route::any('/search-item-groups/{keyword?}{column?}{order?}{limit?}', 'SearchItemGroupController@index');

    Route::get('/item-units', 'ItemUnitController@index');
    Route::get('/item-units/{item_unit}/edit', 'ItemUnitController@edit');
    Route::post('/item-units', 'ItemUnitController@store');
    Route::post('/item-units/{item_unit}', 'ItemUnitController@update');
    Route::any('/search-item-units/{keyword?}{column?}{order?}{limit?}', 'SearchItemUnitController@index');

    Route::get('/item-prices', 'ItemPriceController@index');
    Route::get('/item-prices/{item_price}/edit', 'ItemPriceController@edit');
    Route::post('/item-prices', 'ItemPriceController@store');
    Route::post('/item-prices/{item_price}', 'ItemPriceController@update');
    Route::any('/search-item-prices/{keyword?}{column?}{order?}{limit?}', 'SearchItemPriceController@index');
    Route::any('/search-item/{keyword?}', 'SearchItemController@single');
    Route::any('/search-item-po/{keyword?}', 'SearchItemController@po_single');

    Route::get('/currencies', 'CurrencyController@index');
    Route::get('/currencies/{currency}/edit', 'CurrencyController@edit');
    Route::post('/currencies', 'CurrencyController@store');
    Route::post('/currencies/{currency}', 'CurrencyController@update');
    Route::any('/search-currencies/{keyword?}{column?}{order?}{limit?}', 'SearchCurrencyController@index');

    Route::get('/items', 'ItemController@index');
    Route::get('/items/{item}/edit', 'ItemController@edit');
    Route::post('/items', 'ItemController@store');
    Route::post('/items/{item}', 'ItemController@update');
    Route::any('/search-items/{keyword?}{column?}{order?}{limit?}', 'SearchItemController@index');
    Route::get('/items/{branch}', 'ItemController@show');

    Route::get('/purchase-orders', 'PurchaseOrderController@index');
    Route::get('/purchase-orders/{purchase_order}/edit', 'PurchaseOrderController@edit');
    Route::post('/purchase-orders', 'PurchaseOrderController@store');
    Route::post('/purchase-orders/{purchase_order}', 'PurchaseOrderController@update');
    Route::any('/search-purchase-orders/{keyword?}{column?}{order?}{limit?}', 'SearchPurchaseOrderController@index');

    Route::any('/search-creditor/{keyword?}', 'SearchCreditorController@single');
    Route::any('/search-debtor/{keyword?}', 'SearchDebtorController@single');
   });

   Route::get('/{vue_capture?}', function () {
    return view('layouts.admin');
   })->where('vue_capture', '[\/\w\.\,\-]*');

