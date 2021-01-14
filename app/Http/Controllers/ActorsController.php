<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests\ActorStoreRequest;
use App\Http\Requests\ActorUpdateRequest;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorsController extends Controller
{
    /**
     * Index actor.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        $actors = parent::sort(Actor::filters($request), $request->input('sort'))->get();

        return parent::formatResponse($actors, "Successfully",200,  true, $request->input('page'), $request->input('per_page'));

    }
    /**
     * Show the specified actor.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $actor = Actor::findOrFail($id);

        //GET favorite Genre of Actor
        $countByGenre = Movie::where('actor_movie.actor_id', $id)
        ->select(DB::raw("genres.name as genre"))
        ->AddSelect(DB::raw('count(movies.genre_id) as movies_in_genre'))
        ->join('actor_movie', 'movies.id', '=', 'actor_movie.movie_id')
        ->join(
            'genres',
            'genres.id',
            '=',
            'movies.genre_id'
        )
        ->groupBy('movies.genre_id')
        ->orderBy('movies_in_genre', 'desc')
        ->get();

        $actor['participation_by_gender'] = $countByGenre;

        return parent::formatResponse($actor, "Successfully", 200);
    }

    /**
     * Create the specified actor.
     *
     * @param  ActorStoreRequest  $request
     * @return Response
     */
    public function store(ActorStoreRequest $request)
    {
        $actor = new Actor($request->validated());
        $actor->save();
        
        return parent::formatResponse($actor, "Successfully", 201);
    }
    /**
     * Update the specified actor.
     *
     * @param  actorUpdateRequest  $request
     * @param  string  $id
     * @return Response
     */
    public function update(ActorUpdateRequest $request, $id)
    {
        $actor = actor::findOrFail($id);
        $actor->update($request->validated());

        return parent::formatResponse($actor, "Successfully", 200);

    }
    /**
     * Destroy the specified actor.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function destroy($id)
    {
        $actor = actor::find($id);
        $actor->delete();

        return parent::formatResponse($actor, "Successfully", 204);

    }
}
