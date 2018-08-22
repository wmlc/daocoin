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
Route::get('/setPaymentMethod', 'PurchaseController@setPaymentMethod');
Route::post('/setPaymentMethod', 'PurchaseController@setPaymentMethod');




Route::any('/upload', 'FileController@upload');




