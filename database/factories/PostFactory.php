<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Post;
use App\Category ;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'content' => $faker->paragraph,      
        'category_id' => Category::all()->random()->id,
        'active' => 1 ,
        'user_id' => User::all()->random()->id,
    ];
});
