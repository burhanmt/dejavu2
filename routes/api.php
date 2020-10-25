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

    // PartOfSpeeches
    Route::apiResource(
        'part-of-speeches',
        'PartOfSpeechesController'
    );
    Route::get(
        'part-of-speeches/{part_of_speech}/relationships/part-of-speech-translations',
        'PartOfSpeechesPartOfSpeechTranslationsRelationshipsController@index'
    )->name('part-of-speeches.relationships.part-of-speech-translations');
    Route::get(
        'part-of-speeches/{part_of_speech}/part-of-speech-translations',
        'PartOfSpeechesPartOfSpeechTranslationsRelatedController@index'
    )->name('part-of-speeches.part-of-speech-translations');

    // MemoryLevels
    Route::apiResource(
        'memory-levels',
        'MemoryLevelsController'
    );
    Route::get(
        'memory-levels/{memory_level}/relationships/memory-level-translations',
        'MemoryLevelsMemoryLevelTranslationsRelationshipsController@index'
    )->name('memory-levels.relationships.memory-level-translations');
    Route::get(
        'memory-levels/{memory_level}/memory-level-translations',
        'MemoryLevelsMemoryLevelTranslationsRelatedController@index'
    )->name('memory-levels.memory-level-translations');

    // Goals
    Route::apiResource(
        'goals',
        'GoalsController'
    );
    Route::get(
        'goals/{goal}/relationships/goal-translations',
        'GoalsGoalTranslationsRelationshipsController@index'
    )->name('goals.relationships.goal-translations');
    Route::get(
        'goals/{goal}/goal-translations',
        'GoalsGoalTranslationsRelatedController@index'
    )->name('goals.goal-translations');

    // Interests
    Route::apiResource(
        'interests',
        'InterestsController'
    );
    Route::get(
        'interests/{interest}/relationships/interest-translations',
        'InterestsInterestTranslationsRelationshipsController@index'
    )->name('interests.relationships.interest-translations');
    Route::get(
        'interests/{interest}/interest-translations',
        'InterestsInterestTranslationsRelatedController@index'
    )->name('interests.interest-translations');

    // DejavuClients
    Route::apiResource(
        'dejavu-clients',
        'DejavuClientsController'
    );
    Route::get(
        'dejavu-clients/{dejavu_client}/relationships/users',
        'DejavuClientsUsersRelationshipController@index'
    )->name('dejavu-clients.relationships.users');
    Route::get(
        'dejavu-clients/{dejavu_client}/users',
        'DejavuClientsUsersRelatedController@index'
    )->name('dejavu-clients.users');

    // Users
    // todo-missing: DejavuClient Relationship is missing.
    Route::apiResource(
        'users',
        'UsersController'
    );
    Route::get(
        'users/{user}/relationships/dejavu-clients',
        'UsersDejavuClientsRelationshipsController@index'
    )->name('users.relationships.dejavu-clients');
    Route::get(
        'users/{user}/dejavu-clients',
        'UsersDejavuClientsRelatedController@index'
    )->name('users.dejavu-clients');
});
