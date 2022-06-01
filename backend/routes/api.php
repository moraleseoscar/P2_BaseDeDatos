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
use App\Http\Controllers\Anuncio\AnuncioController;
use App\Http\Controllers\Reports\ReportsController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\Content\ContentController;
use App\Http\Controllers\Bitacora\BitacoraController;

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
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth:api');
Route::get('/bitacora', [BitacoraController::class, 'getBitacora'])->middleware('auth:api');
Route::post('/user', [UserController::class, 'save_user'])->middleware('auth:api');
Route::put('/user', [UserController::class, 'update'])->middleware('auth:api');
Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->middleware('auth:api');
Route::get('/la-capital/{id}', [FavoriteController::class, 'laCapital'])->middleware('auth:api');
Route::get('/user-list', [UserController::class, 'list'])->middleware('auth:api');
Route::get('/list-content-profile/{perfil}', [ContentController::class, 'listProfile'])->middleware('auth:api');
Route::apiResource('/profile', ProfileController::class)->middleware('auth:api');
Route::apiResource('/content', ContentController::class)->middleware('auth:api');
Route::apiResource('/director', DirectorController::class)->middleware('auth:api');
Route::apiResource('/film', MovieSerieController::class)->middleware('auth:api');
Route::apiResource('/anuncio', AnuncioController::class)->middleware('auth:api');
Route::apiResource('/fav', FavoriteController::class)->middleware('auth:api');
Route::apiResource('/actor', ActorController::class)->middleware('auth:api');
Route::get('/some-actors', 'App\Http\Controllers\Actor\ActorController@getSomeActors')->middleware('auth:api');
Route::get('/some-directors', 'App\Http\Controllers\Director\DirectorController@getSomeDirectors')->middleware('auth:api');
Route::get('/some-awards', 'App\Http\Controllers\Award\AwardController@getSomeAwards')->middleware('auth:api');
Route::apiResource('/award', ActorController::class)->middleware('auth:api');
Route::apiResource('/movie-serie', MovieSerieController::class)->middleware('auth:api');
Route::get('/show-movie-serie-detail/{id}/{profile}', 'App\Http\Controllers\MovieSerie\MovieSerieController@showDetails')->middleware('auth:api');
Route::get('/filter-movie-serie/{search}/{tipo}/{id}', 'App\Http\Controllers\MovieSerie\MovieSerieController@filterMovies')->middleware('auth:api');
Route::apiResource('/category', CategoryController::class)->middleware('auth:api');
Route::get('/verify-type', 'App\Http\Controllers\User\UserController@verifyType')->middleware('auth:api');
Route::get('/user-profiles', 'App\Http\Controllers\Profile\ProfileController@getUserProfiles')->middleware('auth:api');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::apiResource('/reports', ReportsController::class)->middleware('auth:api');
//Aqui falta el de la paigina de las querys

Route::get('/top-10-categories/{name}/{name2}', 'App\Http\Controllers\Reports\ReportsController@getTop10Cat')->middleware('auth:api');

Route::get('/reprod-por-cat/{name}/{name2}', 'App\Http\Controllers\Reports\ReportsController@getReproduccionesPorCategoria')->middleware('auth:api');

Route::get('/top-10-actors-directors', 'App\Http\Controllers\Reports\ReportsController@getTop10ActorAndDirectorsForEstandarAndAdvance')->middleware('auth:api');
Route::get('/created-account-6-months', 'App\Http\Controllers\Reports\ReportsController@getCantidadCreatedAdvanAcount')->middleware('auth:api');

Route::get('/hora-pico-por-fecha/{name}', 'App\Http\Controllers\Reports\ReportsController@getHoraPicoPorFecha')->middleware('auth:api');





Route::get('/simulacion/{fecha}/{cantidad}', 'App\Http\Controllers\Reports\ReportsController@createSimulation')->middleware('auth:api');
Route::get('/top-5-content-per-month/{name}/{name2}', 'App\Http\Controllers\Reports\ReportsController@getTop5ContentPerMonth')->middleware('auth:api');

Route::get('/top-10-busquedas', 'App\Http\Controllers\Reports\ReportsController@getTop10Busquedas')->middleware('auth:api');

Route::get('/top-20-left-behind-content/{name}/{name2}', 'App\Http\Controllers\Reports\ReportsController@getTop20LeftBehindContent')->middleware('auth:api');
Route::get('/new-search/{name}', 'App\Http\Controllers\Reports\ReportsController@postNewSearchOnDB')->middleware('auth:api');
