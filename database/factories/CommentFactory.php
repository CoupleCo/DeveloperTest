<?php

use App\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Comment::class, function (Faker $faker) {
    return [
    	'user_id' => function() {
    		return factory('App\User')->create()->id;
    	},
    	'picture_id' => function() {
    		return factory('App\Picture')->create()->id;
    	},
        'body' => $faker->paragraph
    ];
});
