<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Actor\ActorController;
use App\Http\Controllers\MovieSerie\MovieSerieController;
use App\Http\Controllers\Director\DirectorController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Award\AwardController;

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
Route::get('/some-actors', 'App\Http\Controllers\Actor\ActorController@getSomeActors')->middleware('auth:api');
Route::get('/some-directors', 'App\Http\Controllers\Director\DirectorController@getSomeDirectors')->middleware('auth:api');
Route::get('/some-awards', 'App\Http\Controllers\Award\AwardController@getSomeAwards')->middleware('auth:api');
Route::apiResource('/award', ActorController::class)->middleware('auth:api');
Route::apiResource('/movie-serie', MovieSerieController::class)->middleware('auth:api');
Route::get('/show-movie-serie-detail/{id}', 'App\Http\Controllers\MovieSerie\MovieSerieController@showDetails')->middleware('auth:api');
Route::get('/filter-movie-serie/{search}/{tipo}/{id}', 'App\Http\Controllers\MovieSerie\MovieSerieController@filterMovies')->middleware('auth:api');
Route::apiResource('/category', CategoryController::class)->middleware('auth:api');
Route::get('/verify-type', 'App\Http\Controllers\User\UserController@verifyType')->middleware('auth:api');
Route::get('/user-profiles', 'App\Http\Controllers\Profile\ProfileController@getUserProfiles')->middleware('auth:api');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);