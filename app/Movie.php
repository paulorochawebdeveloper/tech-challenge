<?php

namespace App;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'year',
        'synopsis',
        'runtime',
        'released_at',
        'cost',
        'genre_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->withPivot('appearances');;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Scope a query to only include breed of a given filter.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilters($query, $filters)
    {
        if($filters->input('name')){
            $query->where('movies.name', 'LIKE', '%' . $filters->input('name') . '%');
        }

        if($filters->route('actor_id')){
            $id = $filters->route('actor_id');
            $query->whereHas('actors', function (Builder $queryBuilder ) use ($id) {
                $queryBuilder->where('id', $id);
            });
        }

        return $query;

    }
}
