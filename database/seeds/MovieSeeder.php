<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        factory(Movie::class, 15)->create()->each(function ($actor) {
            $actor->actors()->saveMany(App\Actor::inRandomOrder()->take(mt_rand(1, 3))->get());
            $actor->actors()->saveMany(App\Actor::inRandomOrder()->take(mt_rand(4, 6))->get());
            $actor->actors()->saveMany(App\Actor::inRandomOrder()->take(mt_rand(7, 10))->get());
        });
    }
}