<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Genre;
use Faker\Generator as Faker;

$factory->define(\App\Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'year' => $faker->year(),
        'synopsis' =>  $faker->sentence(1),
        "runtime" => 120,
        "released_at" =>  $faker->date('Y-m-d'),
        "cost" => "10",
        "genre_id" => Genre::inRandomOrder()->first()->id,
    ];
});
