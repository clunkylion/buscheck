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

//API ROUTES
Route::apiResource('/enterprise', 'EnterpriseController');
Route::apiResource('/client', 'ClientController');
Route::apiResource('/user', 'UserController');
Route::apiResource('/driver', 'DriverController');
Route::apiResource('/origin', 'OriginController');
Route::apiResource('/destination', 'DestinationController');
Route::apiResource('/hour', 'HourController');
Route::apiResource('/bus', 'BusController');
Route::apiResource('/photoBus', 'BusPhotoController');
Route::apiResource('/ticket', 'TicketController');
Route::apiResource('/totalSale', 'TotalSaleController');