<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\BuyerController;
use App\Http\Controllers\Api\ItemUmoController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\TilAccessoriesController;
use App\Http\Controllers\Api\ItemTilAccessoriesController;
use App\Http\Controllers\Api\BuyerTilAccessoriesController;
use App\Http\Controllers\Api\ItemUmoTilAccessoriesController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('buyers', BuyerController::class);

        // Buyer Til Accessories
        Route::get('/buyers/{buyer}/til-accessories', [
            BuyerTilAccessoriesController::class,
            'index',
        ])->name('buyers.til-accessories.index');
        Route::post('/buyers/{buyer}/til-accessories', [
            BuyerTilAccessoriesController::class,
            'store',
        ])->name('buyers.til-accessories.store');

        Route::apiResource('items', ItemController::class);

        // Item Til Accessories
        Route::get('/items/{item}/til-accessories', [
            ItemTilAccessoriesController::class,
            'index',
        ])->name('items.til-accessories.index');
        Route::post('/items/{item}/til-accessories', [
            ItemTilAccessoriesController::class,
            'store',
        ])->name('items.til-accessories.store');

        Route::apiResource('item-umos', ItemUmoController::class);

        // ItemUmo Til Accessories
        Route::get('/item-umos/{itemUmo}/til-accessories', [
            ItemUmoTilAccessoriesController::class,
            'index',
        ])->name('item-umos.til-accessories.index');
        Route::post('/item-umos/{itemUmo}/til-accessories', [
            ItemUmoTilAccessoriesController::class,
            'store',
        ])->name('item-umos.til-accessories.store');

        Route::apiResource('til-accessories', TilAccessoriesController::class);
    });
