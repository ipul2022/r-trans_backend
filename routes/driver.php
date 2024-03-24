<?php

use App\Http\Controllers\DriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// reset code password
Route::post('get-code',[DriverController::class, 'get_code']);
Route::post('reset-password',[DriverController::class, 'get_password']);

//
Route::post('register',[DriverController::class, 'register']);
Route::post('login',[DriverController::class, 'login']);
Route::group([
    'middleware' => 'auth:sanctum',
], function ($router) {

    //refreshToken
    Route::get('get-profile',[DriverController::class, 'get_profile']);
    Route::post('update-profile',[DriverController::class, 'update']);
    Route::post('refresh-token',[DriverController::class, 'refreshToken']);
    //
    Route::get('get-order-ride',[DriverController::class, 'get_order']);
    Route::get('get-order-shop',[DriverController::class, 'get_order_shop']);
    Route::get('get-order-pickup',[DriverController::class, 'get_order_pickup']);
    Route::get('get-total',[DriverController::class, 'get_total']);

    //
    Route::post('update-password',[DriverController::class, 'update_password']);
    Route::get('get-list-shop',[DriverController::class, 'get_list_shop']);
    Route::get('get-list-ride',[DriverController::class, 'get_list_ride']);
    Route::get('get-list-pickup',[DriverController::class, 'get_list_pickup']);
    //
    Route::post('update-status',[DriverController::class, 'update_status']);
    Route::post('update-location',[DriverController::class, 'update_location']);

});
