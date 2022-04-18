<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Actor\ActorController;
use App\Http\Controllers\MovieSerie\MovieSerieController;
use App\Http\Controllers\Director\DirectorController;
use App\Http\Controllers\Reports\ReportsController;


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
Route::get('/user', [UserController::class, 'get'])->middleware('auth:api');
Route::apiResource('/profile', ProfileController::class)->middleware('auth:api');
Route::apiResource('/director', DirectorController::class)->middleware('auth:api');
Route::apiResource('/film', MovieSerieController::class)->middleware('auth:api');
Route::apiResource('/actor', ActorController::class)->middleware('auth:api');
Route::apiResource('/movie-serie', MovieSerieController::class)->middleware('auth:api');
Route::get('/verify-type', 'App\Http\Controllers\User\UserController@verifyType')->middleware('auth:api');
Route::get('/user-profiles', 'App\Http\Controllers\Profile\ProfileController@getUserProfiles')->middleware('auth:api');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::get('/top-10-categories/:id/:id2', 'App\Http\Controllers\Reports\ReportsController@getTop10Cat')->middleware('auth:api');

Route::get('/reprod-por-cat/:id/:id2', 'App\Http\Controllers\Reports\ReportsController@getReproduccionesPorCategoria')->middleware('auth:api');

Route::get('/top-10-actors-directors', 'App\Http\Controllers\Reports\ReportsController@getTop10ActorAndDirectorsForEstandarAndAdvance')->middleware('auth:api');

Route::get('/created-account-6-months', 'App\Http\Controllers\Reports\ReportsController@getCantidadCreatedAdvanAcount')->middleware('auth:api');

Route::get('/hora-pico-por-fecha/:id', 'App\Http\Controllers\Reports\ReportsController@getHoraPicoPorFecha')->middleware('auth:api');