<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    /**
     * Index breed.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        $movies = parent::sort(Movie::filters($request), $request->input('sort'))->get();

        return parent::formatResponse($movies, "Successfully",200,  true, $request->input('page'), $request->input('per_page'));

    }
    /**
     * Show the specified breed.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        return parent::formatResponse($movie, "Successfully", 200);
    }

    /**
     * Create the specified movie.
     *
     * @param  MovieStoreRequest  $request
     * @return Response
     */
    public function store(MovieStoreRequest $request)
    {
        $movie = new Movie($request->validated());
        $movie->save();
        
        return parent::formatResponse($movie, "Successfully", 201);
    }
    /**
     * Update the specified breed.
     *
     * @param  MovieUpdateRequest  $request
     * @param  string  $id
     * @return Response
     */
    public function update(MovieUpdateRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->validated());

        return parent::formatResponse($movie, "Successfully", 200);

    }
    /**
     * Destroy the specified movie.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return parent::formatResponse($movie, "Successfully", 204);

    }
}
