<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->username;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
