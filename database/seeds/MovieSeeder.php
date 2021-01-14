<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        
        factory(Movie::class, 15)->create()->each(function ($movie) {
            $actors = App\Actor::inRandomOrder()->take(3)->get();
            foreach ($actors as $actorAttach) {
                $appearances = mt_rand(1,3);
                $movie->actors()->attach(
                    [
                        $actorAttach['id'] => [
                         'appearances' => $appearances
                    ]]);
            }
        });
    }
}