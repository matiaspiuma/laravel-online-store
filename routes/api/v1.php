<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('auth:me');

/**
 * Products Routes
 */
Route::prefix('products')->as('products:')->group(function () {
    Route::get(
        '/',
        App\Http\Controllers\Api\V1\Products\IndexController::class
    )->name('index');

    Route::get(
        '/{product}',
        App\Http\Controllers\Api\V1\Products\ShowController::class
    )->name('show');
});

/**
 * Cart Routes
 */
Route::prefix('carts')->as('carts:')->group(function () {
    Route::get(
        '/',
        App\Http\Controllers\Api\V1\Carts\IndexController::class
    )->name('index');

    Route::post(
        '/',
        App\Http\Controllers\Api\V1\Carts\StoreController::class
    )->name('store');

    Route::post(
        '/{cart:uuid}/products',
        App\Http\Controllers\Api\V1\Carts\Products\StoreController::class
    )->name('products:store');

    // Route::patch(
    //     '/{cart:uuid}/products/{cartItem}',
    //     App\Http\Controllers\Api\V1\Carts\Products\UpdateController::class
    // )->name('products:update');

    // Route::delete(
    //     '/{cart:uuid}/products/{cartItem}',
    //     App\Http\Controllers\Api\V1\Carts\Products\DeleteController::class
    // )->name('products:delete');
});