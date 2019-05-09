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
    return view('welcome');
});

Route::get('/order/subscription', 'Payments\Verotel\VerotelController@subscriptionOrder')->name('order.verotel.subscription');
Route::get('/order/purchase', 'Payments\Verotel\VerotelController@purchaseOrder')->name('order.verotel.purchase');
Route::get('/subscribe', 'Payments\Verotel\VerotelController@subscribe')->name('payment.verotel.subscribe');
Route::get('/purchase', 'Payments\Verotel\VerotelController@purchase')->name('payment.verotel.purchase');
Route::get('/payment/verotel/postback', 'Payments\Verotel\VerotelController@postback')->name('payment.verotel.postback');
Route::get('/payment/verotel/callback', 'Payments\Verotel\VerotelController@callback')->name('payment.verotel.callback');
