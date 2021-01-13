<?php

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