<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
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
// reset password
Route::post('sendCode',[ForgotPasswordController::class, 'generate']);
Route::post('get-code',[ForgotPasswordController::class, 'get_code']);
Route::post('reset-password',[ResetPasswordController::class, 'get_password']);
//
Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);


Route::group([
    'middleware' => 'auth:api',
], function ($router) {
//auth user
    Route::get('get-profile',[UserController::class, 'get_profile']);
    Route::post('change-password',[UserController::class, 'change_password']);
    Route::post('update-profile',[UserController::class, 'update']);
    Route::post('upload-image',[UserController::class, 'upload_image']);
   // Route::get('image/{path}', [UserController::class, 'getImage'])->where('path', '.*');
    Route::post('logout',[UserController::class, 'logout']);

    //


    // order by user
  // Route::get('get-order',[OrderController::class, 'get_order']);
    Route::post('create-order',[OrderController::class, 'create_order']);
    Route::post('create-order-shop',[OrderController::class, 'create_order_shop']);
    Route::post('create-order-pickup',[OrderController::class, 'create_order_pickup']);


    //
 //   Route::post('cancel-order',[OrderController::class, 'cancel_order']);
    Route::get('detail-order/{id}',[OrderController::class, 'get_detail_order']);
    Route::post('history-order/{user_id}',[OrderController::class, 'history_order']);
    Route::get('show/{id}',[OrderController::class, 'show']);

    // cek input order by admin
    // Route::resource('order.accept.',AcceptOrderController::class);


    //get receipt order
    Route::get('get-receipt',[OrderController::class, 'get_receipt']);
    Route::get('get-receipt-shop',[OrderController::class, 'get_receipt_shop']);
    Route::get('get-receipt-pickup',[OrderController::class, 'get_receipt_pickup']);
   // Route::post('update-status/{id}',[OrderController::class, 'update_status']);
    Route::get('get-List',[OrderController::class, 'get_List']);
    Route::get('get-List-shop',[OrderController::class, 'get_List_shop']);
    Route::get('get-List-pickup',[OrderController::class, 'get_List_pickup']);
    Route::post('delete-order/{id}',[OrderController::class, 'delete_order']);

});
