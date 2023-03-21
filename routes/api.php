<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/index', [ApiController::class, 'index']);

Route::get('v1/search', [ApiController::class, 'filter']);

Route::get('v1/profile_path{user}', [ApiController::class, 'getImgProfile']);

Route::get('v1/reviews{user}', [ApiController::class, 'getReviews']);
