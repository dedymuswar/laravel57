<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'order_costumer_name' => $faker->name(),
        'order_item' => $faker->word,
        'order_value' => $faker->randomNumber(5),
        'order_date' => $faker->date(),
    ];
});
