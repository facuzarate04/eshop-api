<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->middleware([])->group(function () {

    Route::prefix('products')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [ProductController::class,'index']);
        Route::get('{product}', [ProductController::class,'show']);
    });

    Route::prefix('categories')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [CategoryController::class,'index']);
        Route::prefix('sub')->middleware([])->group(function () {
            Route::get('/', [SubCategoryController::class,'index']);
        });
    });

    Route::prefix('delivery-methods')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [DeliveryMethodController::class,'index']);
    });

    Route::prefix('payment-methods')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [PaymentMethodController::class,'index']);
    });

    Route::prefix('orders')->middleware(['auth:sanctum'])->group(function () {
        Route::post('/', [OrderController::class,'store']);
    });

});
