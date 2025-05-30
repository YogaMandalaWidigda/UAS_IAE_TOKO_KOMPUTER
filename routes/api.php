<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
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

Route::prefix('shipments')->group(function () {
    Route::post('/', [ShipmentController::class, 'create']);
    Route::get('/{id}', [ShipmentController::class, 'show']);
    Route::put('/{id}/status', [ShipmentController::class, 'updateStatus']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


