<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * ***************************************
 *  Dejavu Users / Partners API - v1     *
 * ***************************************
 */

// User Login
Route::namespace('\App\Http\Controllers\Api\V1')->prefix('v1')->middleware('api')->group(function () {
    // Login v1
    Route::post(
        '/login',
        'LoginController@login'
    );
});

Route::namespace('\App\Http\Controllers\Api\V1')->middleware('auth:api')->prefix('v1')->group(function () {
    Route::apiResource(
        'dejavu-l1-languages',
        'DejavuL1LanguagesController'
    );

    Route::apiResource(
        'dejavu-l2-languages',
        'DejavuL2LanguagesController'
    );
});
