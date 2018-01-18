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
Route::get('/myUrl', 'visitController@myUrl');
Route::get('/home', 'HomeController@index');
Route::get('/admin', 'IndexController@admin');
Route::post('/Adlogin', 'IndexController@Adlogin');
Route::any('/payVerify', 'CustomerController@payVerify');
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
    Route::post('/checkUrl', 'PartnerController@checkUrl');
    Route::post('/urls', 'PartnerController@urlsLs');
    Route::post('/changePass', 'PartnerController@changePass');
    Route::post('/cardNum', 'PartnerController@cardNum');
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
    Route::post('/regOrder', 'CustomerController@regOrder');
    Route::post('/regCardP', 'CustomerController@regCardP');
    Route::post('/customerOrder', 'CustomerController@customerOrder');
    Route::post('/onlinePay', 'CustomerController@onlinePay');


});





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
    Route::post('/partners', 'AdminController@partnersLs');
    Route::post('/urls', 'AdminController@urlsLs');
    Route::post('/visitsLow', 'AdminController@visitsLow');
    Route::post('/customersLow', 'AdminController@customersLow');
    Route::post('/ordersLow', 'AdminController@ordersLow');
    Route::post('/transActsLow', 'AdminController@transActsLow');
    Route::post('/allUrls', 'AdminController@allUrls');
    Route::post('/visitsLowUrl', 'AdminController@visitsLowUrl');
    Route::post('/customersLowUrl', 'AdminController@customersLowUrl');
    Route::post('/ordersLowUrl', 'AdminController@ordersLowUrl');
    Route::post('/transActsLowUrl', 'AdminController@transActsLowUrl');
    Route::post('/visits', 'AdminController@visits');
    Route::post('/orders', 'AdminController@orders');
    Route::post('/transActs', 'AdminController@transActs');
    Route::post('/cardPs', 'AdminController@cardPs');
    Route::post('/changeCardp', 'AdminController@changeCardp');
    Route::post('/orderInf', 'AdminController@orderInf');
    Route::post('/customers', 'AdminController@customers');
    Route::post('/costomerOrders', 'AdminController@costomerOrders');
    Route::post('/costomerTransActs', 'AdminController@costomerTransActs');
    Route::post('/payRq', 'AdminController@payRq');
    Route::post('/payRqInf', 'AdminController@payRqInf');
    Route::post('/regPayRqRes', 'AdminController@regPayRqRes');
    Route::post('/sendList', 'AdminController@sendList');
    Route::post('/newPrintLs', 'AdminController@newPrintLs');
    Route::get('/printList/{id}', 'AdminController@printList');

});