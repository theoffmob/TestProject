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
});

Route::get('/prize', function () {
    return view('/prize');
});

Route::get('/addPrizes', function () {
    return view('/addPrizes');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('insert','AddPrizes@insertform');
/*Route::post('create','AddPrizes@insert');*/

Route::get('convert','ConvertMoneyToPointsController@convert')->name('convert');

Route::get('createwin','WriteWinningController@createwin')->name('createwin');

Route::post('WinPrizeController','WinPrizeController@initprizes')->name('WinPrize');

Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@payWithpaypal']);
Route::get('/payment/status',['as' => 'status', 'uses' => 'PaymentController@getPaymentStatus']);
