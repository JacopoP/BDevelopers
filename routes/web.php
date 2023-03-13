<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::get('/dashboard', [Emacontroller::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // DeveloperSettings
    Route::get('/developer', [DeveloperController::class, 'DevCreate'])->name('profile.dev.create');

    Route::post('/developer', [DeveloperController::class, 'DevStore'])->name('profile.dev.store');

    Route::get('/developer/delete', [DeveloperController::class, 'DevDelete'])->name('profile.dev.delete');
});

Route::get('/index', [IndexController::class, 'goToIndex'])->name('index');

// developer show per UI
Route::get('/show{id}', [Emacontroller::class, 'DevShow'])->name('show');
Route::post('/review{id}', [Emacontroller::class, 'ReviewStore'])->name('review.store');
Route::post('/message{id}', [Emacontroller::class, 'MessageStore'])->name('message.store');
Route::post('/rating{id}', [Emacontroller::class, 'RatingStore'])->name('rating.store');


require __DIR__ . '/auth.php';
