<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BraintreeController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\IndexController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Emacontroller;

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

Route::get('/', [IndexController::class, 'welcome'])->name('home');



Route::middleware(['auth', 'verified'])->get('/dashboard', [Emacontroller::class, 'Dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/get-sponsored', [BraintreeController::class, 'token'])->name('braintree');

    Route::post('/transaction-result', [BraintreeController::class, 'pay'])->name('payment');

    // DeveloperSettings
    Route::get('/developer', [DeveloperController::class, 'DevCreate'])->name('profile.dev.create');

    Route::post('/developer', [DeveloperController::class, 'DevStore'])->name('profile.dev.store');

    Route::get('/developer/delete', [DeveloperController::class, 'DevDelete'])->name('profile.dev.delete');
});

Route::match(['get', 'post'], '/index', [IndexController::class, 'goToIndex'])->name('index');

Route::post('/index/form', [IndexController::class, 'getForIndex'])->name('index.form');

// developer show per UI
Route::get('/show{id}', [Emacontroller::class, 'DevShow'])->name('show');
Route::post('/review{id}', [Emacontroller::class, 'ReviewStore'])->name('review.store');
Route::post('/message{id}', [Emacontroller::class, 'MessageStore'])->name('message.store');
Route::post('/rating{id}', [Emacontroller::class, 'RatingStore'])->name('rating.store');


require __DIR__ . '/auth.php';
