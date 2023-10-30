<?php

use App\Http\Controllers\API\DefinitionRatingController;
use App\Http\Controllers\API\WordController;
use App\Http\Controllers\API\WordTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/wordTypes', [WordTypeController::class, 'index']);
Route::post('/wordTypes', [WordTypeController::class, 'add']);
Route::get('/wordTypes/{wordType}', [WordTypeController::class, 'get']);
Route::put('/wordTypes/{wordType}', [WordTypeController::class, 'update']);
Route::delete('/wordTypes/{wordType}', [WordTypeController::class, 'remove']);
Route::put('/wordTypes/{wordType}/complete', [WordTypeController::class, 'complete']);

Route::get('/words', [WordController::class, 'index']);
Route::get('/words/search', [WordController::class, 'search'])->name('word.search');
Route::post('/words', [WordController::class, 'add']);
Route::get('/words/{word}', [WordController::class, 'get']);
Route::put('/words/{word}', [WordController::class, 'update']);
Route::delete('/words/{word}', [WordController::class, 'remove']);
Route::put('/words/{word}/complete', [WordController::class, 'complete']);

Route::post('words/{word}/ratings', [DefinitionRatingController::class, 'store']);

Route::get('/definitionRatings', [DefinitionRatingController::class, 'index']);
Route::post('/definitionRatings', [DefinitionRatingController::class, 'store']);
Route::get('/definitionRatings/{definitionRating}', [DefinitionRatingController::class, 'get']);
Route::put('/definitionRatings/{definitionRating}', [DefinitionRatingController::class, 'update']);
Route::delete('/definitionRatings/{definitionRating}', [DefinitionRatingController::class, 'destroy']);
Route::put('/definitionRatings/{definitionRating}/complete', [DefinitionRatingController::class, 'complete']);
