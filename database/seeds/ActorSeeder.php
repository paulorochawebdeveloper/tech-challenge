<?php

use App\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    public function run()
    {
        factory(Actor::class, 10)->create()->each(function ($actor) {
            $actor->genres()->saveMany(App\Models\Genre::inRandomOrder()->take(mt_rand(1, 3))->get());
        });
    }
}
