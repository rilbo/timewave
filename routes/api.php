<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\TimesController;
use App\Http\Controllers\API\v1\TravelAreaController;
use App\Http\Controllers\API\v1\SitesNameController;

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

Route::group(['prefix' => 'v1','namespace' => 'App\Http\Controllers\API\v1'], 
function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get("/profile", [AuthController::class, 'profile']);
        Route::put("/edit-profile", [AuthController::class, 'edit']);
        Route::post("/change-password", [AuthController::class, 'updatePassword']);
        Route::delete("/logout", [AuthController::class, 'logout']);

        // mes heures
        Route::post("/time/create", [TimesController::class, 'store']);

        // companies list
        //Route::get("/companies/list", [CompaniesController::class, 'list']);

        // countries list
        //Route::get("/countries/list", [CountriesController::class, 'list']);

        // trave-area list
        Route::get("/travel-area/list", [TravelAreaController::class, 'list']);

        // name site list
        Route::get("/name-site/list", [SitesNameController::class, 'list']);
    });

    Route::post('/login', [AuthController::class, 'login']);

});


