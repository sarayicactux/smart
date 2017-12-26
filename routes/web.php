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



Auth::routes();
Route::get('/', 'visitController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logOut',function (){Session::forget('partner');
return redirect('/home');});
Route::get('/partners', 'IndexController@index');
Route::post('/cities', 'IndexController@cities');
Route::post('/checkEmail', 'IndexController@checkEmail');
Route::post('/checkMelicode', 'IndexController@checkMelicode');
Route::post('/checkMobile', 'IndexController@checkMobile');
Route::post('/regPartner', 'PartnerController@regPartner');
Route::post('/regCustomer', 'CustomerController@regCustomer');
Route::post('/loginCustomer', 'CustomerController@loginCustomer');
Route::post('/loginPartner', 'PartnerController@loginPartner');
Route::group(['middleware' => ['checkPartner']], function () {
    Route::post('/urls', 'PartnerController@urlsLs');
    Route::post('/urlsAddEdit', 'PartnerController@urlsAddEdit');
    Route::post('/partners/visits', 'PartnerController@visitsLow');
    Route::post('/partners/transActs', 'PartnerController@transActsLow');
    Route::post('/partners/orders', 'PartnerController@ordersLow');
});



