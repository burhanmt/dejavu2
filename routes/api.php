<?php
use Illuminate\Support\Facades\Route;

/**
 * ***************************************
 *  Dejavu Users / Partners API - v1     *
 * ***************************************
 */

/*---------------------------------------
 *  User login
 */
Route::namespace('\App\Http\Controllers\Api\V1')->prefix('v1')->middleware('api')->group(function () {
    // Login v1
    Route::post(
        '/login',
        'LoginController@login'
    );
});
/*----------------------------------------*/

Route::namespace('\App\Http\Controllers\Api\V1')->middleware('auth:api')->prefix('v1')->group(function () {

    // DejavuL1Languages
    Route::apiResource(
        'dejavu-l1-languages',
        'DejavuL1LanguagesController'
    );

    // DejavuL2Languages
    Route::apiResource(
        'dejavu-l2-languages',
        'DejavuL2LanguagesController'
    );

    // TrustLevels
    Route::apiResource(
        'trust-levels',
        'TrustLevelsController'
    );
    Route::get('trust-levels/{trust_level}/relationships/trust-level-translations', 'TrustLevelsTrustLevelTranslationsRelationshipsController@index')
        ->name('trust-levels.relationships.trust-level-translations');
    Route::get('trust-levels/{trust_level}/trust-level-translations', 'TrustLevelsTrustLevelTranslationsRelatedController@index')
        ->name('trust-levels.trust-level-translations');
});
