<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Actor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'bio' => $faker->sentence(1),
        'born_at'    => $faker->date('Y-m-d', 'now'),
    ];
});
