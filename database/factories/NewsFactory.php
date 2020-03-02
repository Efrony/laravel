<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
//use Faker\Generator as Faker;

$factory->define(News::class, function () {
    $faker = Faker\Factory::create('ru_RU');
    return [
        'title' => $faker->realText(rand(30, 50)),
        'text' => $faker->realText(rand(1000, 1500)),
        'private' => (bool)rand(0, 1),
        'category' => (int)rand(1, 6),
    ];
});
