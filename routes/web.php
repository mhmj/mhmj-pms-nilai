<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('/');

Route::get('/test', function () {
    return view('pages.monthly_report_email');
})->name('test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('2y$10$jC5RWIeoTcPJdtoCrezTd.FH6G1WktnJ5GMJKlQahBeOlmWy4Xt4S/email-report', 'MonthlyReport@EmailReport')->name('email-report');



Route::group(['middleware' => 'auth','prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Pages'], function () {

    Route::group(['middleware' => 'Admin'], function(){
        Route::get('company', 'AdminPageController@company')->name('company');
        Route::get('user', 'AdminPageController@user')->name('user');
    });


    Route::get('packaging', 'AdminPageController@Packaging')->name('packaging');
    Route::get('category', 'AdminPageController@Category')->name('category');
    Route::get('type', 'AdminPageController@Type')->name('type');
    Route::get('shipment-in', 'AdminPageController@ShipmentIn')->name('shipment-in');
    Route::get('shipment-out', 'AdminPageController@ShipmentOut')->name('shipment-out');
    Route::get('DO-Summary', 'AdminPageController@DoSummary')->name('DO-Summary');
    // Route::get('shipment-details/{ship}', 'AdminPageController@ShipmentDetails')->name('shipment-details');
    Route::get('shipment-out-details/{ship}', function ($shipId) {
        return view('pages.Admin.Shipment.Out.details',['shipId' => $shipId]);
    });
    Route::get('DO-Summary-shipment-out-details/{ship}', function ($shipId) {
        return view('pages.Admin.Shipment.DOSummary.details',['shipId' => $shipId]);
    });
});

Route::group(['middleware' => 'auth','prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Pages'], function () {

    Route::group(['middleware' => 'Customer'], function(){
        Route::get('company', 'CustomerPageController@company')->name('company');
        Route::get('user', 'CustomerPageController@user')->name('user');
    });
    Route::get('customer/shipment-out-details/{ship}', function ($shipId) {
        return view('pages.Customer.Shipment.Out.details',['shipId' => $shipId]);
    });


});