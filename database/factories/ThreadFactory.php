<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'subject'   => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'thread'    =>  $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type'      =>  $faker->sentence($nbWords = 1, $variableNbWords = true),
    ];
});
