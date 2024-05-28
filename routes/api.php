<?php

use App\Http\Controllers\Movie\LoginController;
use App\Http\Controllers\Movie\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/login', [LoginController::class, 'login']);

Route::post('movies/list', [MovieController::class, 'list']);
Route::post('movies/filter', [MovieController::class, 'filter']);
Route::post('movies/search', [MovieController::class, 'search']);

Route::apiResource('movies', MovieController::class);



Route::group(['middleware' => 'jwt'], function () {
    // Route to add a movie to the watchlist
    Route::post('movies/{movie}/watchlist', [MovieController::class, 'addToWatchlist']);

    // Route to mark a movie as favorite
    Route::post('movies/{movie}/favorite', [MovieController::class, 'markAsFavorite']);



});
// Route to get imdb details favorite
Route::post('favorites/{favorite}/fetch-imdb-details', [MovieController::class, 'fetchImdbDetails']);
