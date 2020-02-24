<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $img = $faker->boolean() ? 'img/placeholder.png' : null;
    return [
        'user_id' => factory(User::class),
        'body' => $faker->sentence,
        'image' => $img
    ];
});
