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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/OverView', 'OverViewController@index');
Route::get('/kyc', 'KycController@index');
Route::get('/order', 'OrderController@index');
Route::get('/settings', 'SettingsController@index');
Route::post('sendEmailCode', 'EmailController@sendEmailCode');
Route::post('/kyc/save', 'KycController@save');
Route::get('/buy', 'PurchaseController@buy');
Route::post('/dobuy', 'PurchaseController@doBuy');
Route::get('/confirmbuy', 'PurchaseController@confirmBuy');
Route::any('/setPaymentMethod', 'PurchaseController@setPaymentMethod');
Route::get('/redeem', 'PurchaseController@redeem');
Route::post('/saveRedeemOrder', 'PurchaseController@saveRedeemOrder');




Route::any('/upload', 'FileController@upload');




