<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->text(100),
        'created_at' => $faker->dateTimeBetween('-1 weeks'),
        'updated_at' => null,
    ];
});
