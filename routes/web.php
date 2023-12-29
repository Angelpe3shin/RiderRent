<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserBasketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/basket', [UserBasketController::class, 'getBasketForUser'])->name('basket');
Route::post('/basket/{moto}', [UserBasketController::class, 'addToBasket'])->name('add-to-basket');
Route::delete('/basket/{moto}', [UserBasketController::class, 'removeFromBasket'])->name('remove-from-basket');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
