<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\OrderController;


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
Route::prefix('shipments')->group(function () {
    Route::get('/shipments/orders/all', [OrderController::class, 'getAllOrders']);
    Route::post('/', [ShipmentController::class, 'create']);
    Route::get('/{id}', [ShipmentController::class, 'show']);
    Route::put('/{id}/status', [ShipmentController::class, 'updateStatus']);
    Route::get('/orders/customer/{customer_id}', [OrderController::class, 'getOrderFromOrderService']);
    Route::get('/orders/all', [OrderController::class, 'getAllOrders']);});


    