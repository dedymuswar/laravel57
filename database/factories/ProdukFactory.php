<?php

use Faker\Generator as Faker;

$factory->define(App\Produk::class, function (Faker $faker) {
    return [
        'name'          =>  $faker->sentence($nbWords = 2, $variableNbWords = true),
        'kategoris_id'  =>  1,
        'price'         =>  $faker->numberBetween($min = 10000, $max = 100000),
        'thumb'         =>  $faker->firstNameFemale,
        'deskripsi'     =>  $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
