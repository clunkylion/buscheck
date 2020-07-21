<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Public Routes
Route::post('/loginApp', 'AuthController@loginApp')->middleware('cors');;
Route::post('/loginWeb', 'AuthController@loginWeb')->middleware('cors');
Route::post('/signup', 'AuthController@signup')->middleware('cors');;
Route::apiResource('/enterprise', 'EnterpriseController')->middleware('cors');;
//Protected Routes
Route::group(['middleware' => ['auth:api', 'cors']], function(){
    
    Route::apiResource('/client', 'ClientController');
    Route::apiResource('/user', 'UserController');
    Route::apiResource('/driver', 'DriverController');
    Route::apiResource('/origin', 'OriginController');
    Route::apiResource('/destination', 'DestinationController');
    Route::apiResource('/seat', 'SeatController');
    Route::apiResource('/hour', 'HourController');
    Route::apiResource('/bus', 'BusController');
    Route::apiResource('/photoBus', 'BusPhotoController');
    Route::apiResource('/ticket', 'TicketController');
    Route::apiResource('/totalSale', 'TotalSaleController');
});