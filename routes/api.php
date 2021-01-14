<?php

use App\Http\Controllers\ActorsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'genres' => GenreController::class,
]);

Route::prefix('movie')->group(function () {
    Route::post('movies', 'MoviesController@store')
    ->name('movies.store');
    Route::get('movies', 'MoviesController@index')
    ->name('movies.index');
    Route::get('movies/{id}', 'MoviesController@show')
    ->name('movies.show');
    Route::put('/movies/{id}', 'MoviesController@update')
    ->name('movies.update');
    Route::delete('/movies/{id}', 'MoviesController@destroy')
    ->name('movies.delete');
});

Route::prefix('actor')->group(function () {
    Route::post('actors', 'ActorsController@store')
    ->name('actors.store');
    Route::get('actors', 'ActorsController@index')
    ->name('actors.index');
    Route::get('actors/{id}', 'ActorsController@show')
    ->name('actors.show');
    Route::put('/actors/{id}', 'ActorsController@update')
    ->name('actors.update');
    Route::delete('/actors/{id}', 'ActorsController@destroy')
    ->name('actors.delete');

    //actor movies
    Route::get('actors/{actor_id}/movies', 'MoviesController@index')
    ->name('actors.movies');
});
