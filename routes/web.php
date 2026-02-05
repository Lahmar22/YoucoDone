<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('myRestaurant', [RestaurantController::class, 'myRestaurant'])->name('myRestaurant');

Route::get('myMenu', [MenuController::class, 'myMenu'])->name('myMenu');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('restaurants.store', [RestaurantController::class, 'store'])->name('restaurants.store');

Route::delete('restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

Route::put('restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');

Route::get('menus.show/{menu}', [MenuController::class, 'show'])->name('menus.show');

Route::get('menus/items/{menuId}', [MenuController::class, 'getMenuItems'])->name('menus.getItems');

Route::post('menus.store', [MenuController::class, 'store'])->name('menus.store');

Route::post('menus.itemsStore', [MenuController::class, 'itemsStore'])->name('menus.itemsStore');

Route::delete('menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

Route::delete('menus/{menuId}/items/{itemId}', [MenuController::class, 'deleteItem'])->name('menus.deleteItem');