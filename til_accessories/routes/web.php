<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ItemUmoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TilAccessoriesController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('buyers', BuyerController::class);
        Route::resource('items', ItemController::class);
        Route::resource('item-umos', ItemUmoController::class);
        Route::get('til-accessories', [
            TilAccessoriesController::class,
            'index',
        ])->name('til-accessories.index');
        Route::post('til-accessories', [
            TilAccessoriesController::class,
            'store',
        ])->name('til-accessories.store');
        Route::get('til-accessories/create', [
            TilAccessoriesController::class,
            'create',
        ])->name('til-accessories.create');
        Route::get('til-accessories/{tilAccessories}', [
            TilAccessoriesController::class,
            'show',
        ])->name('til-accessories.show');
        Route::get('til-accessories/{tilAccessories}/edit', [
            TilAccessoriesController::class,
            'edit',
        ])->name('til-accessories.edit');
        Route::put('til-accessories/{tilAccessories}', [
            TilAccessoriesController::class,
            'update',
        ])->name('til-accessories.update');
        Route::delete('til-accessories/{tilAccessories}', [
            TilAccessoriesController::class,
            'destroy',
        ])->name('til-accessories.destroy');
        // Import Excel
        Route::get('/import-accessories', [TilAccessoriesController::class, 'importExcel'])->name('import-accessories');
        Route::post('/upload-accessories', [TilAccessoriesController::class, 'updateExcel'])->name('upload-accessories');
    });
