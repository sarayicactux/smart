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
Route::get('/admin', 'indexController@admin');
Route::post('/Adlogin', 'indexController@Adlogin');
Route::get('/logOut',function (){Session::forget('partner');Session::forget('customer');
    Auth::logout();
return redirect('/');});
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
    Route::post('/bills', 'PartnerController@bills');
    Route::post('/payRq', 'PartnerController@payRq');
    Route::post('/regPayRq', 'PartnerController@regPayRq');
    Route::post('/partners/payRqInf', 'PartnerController@payRqInf');
});
Route::group(['middleware' => ['checkCustomer']], function () {
    Route::post('/regOrder', 'customerController@regOrder');
    Route::post('/regCardP', 'customerController@regCardP');
    Route::post('/customerOrder', 'customerController@customerOrder');

});





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
    Route::post('/partners', 'adminController@partnersLs');
    Route::post('/urls', 'adminController@urlsLs');
    Route::post('/visitsLow', 'adminController@visitsLow');
    Route::post('/customersLow', 'adminController@customersLow');
    Route::post('/ordersLow', 'adminController@ordersLow');
    Route::post('/transActsLow', 'adminController@transActsLow');
    Route::post('/allUrls', 'adminController@allUrls');
    Route::post('/visitsLowUrl', 'adminController@visitsLowUrl');
    Route::post('/customersLowUrl', 'adminController@customersLowUrl');
    Route::post('/ordersLowUrl', 'adminController@ordersLowUrl');
    Route::post('/transActsLowUrl', 'adminController@transActsLowUrl');
    Route::post('/visits', 'adminController@visits');
    Route::post('/orders', 'adminController@orders');
    Route::post('/transActs', 'adminController@transActs');
    Route::post('/cardPs', 'adminController@cardPs');
    Route::post('/changeCardp', 'adminController@changeCardp');
    Route::post('/orderInf', 'adminController@orderInf');
    Route::post('/customers', 'adminController@customers');
    Route::post('/costomerOrders', 'adminController@costomerOrders');
    Route::post('/costomerTransActs', 'adminController@costomerTransActs');
    Route::post('/payRq', 'adminController@payRq');
    Route::post('/payRqInf', 'AdminController@payRqInf');
    Route::post('/regPayRqRes', 'AdminController@regPayRqRes');

});