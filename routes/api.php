<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryHotelController;
use App\Http\Controllers\RegionController;

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

Route::middleware('api')->group(function () {
    // Routes for HotelController
    Route::resource('hotels', HotelController::class);

    // Routes for ReservationController
    Route::resource('reservations', ReservationController::class);

    // Routes for ClientController
    Route::resource('clients', ClientController::class);

    // Routes for CategoryHotelController
    Route::resource('category_hotels', CategoryHotelController::class);
    // Routes for Region
    Route::resource('regions', RegionController::class);
    Route::get('hotels/filter_by_star', 'HotelController@filterByStarNumber');


Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
});
