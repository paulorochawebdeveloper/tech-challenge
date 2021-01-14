<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        factory(Movie::class, 15)->create()->each(function ($actor) {
            $actor->actors()->saveMany(App\Actor::inRandomOrder()->take(3)->get());
        });
    }
}