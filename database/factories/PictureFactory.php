<?php

use App\Picture;
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

$factory->define(Picture::class, function (Faker $faker) {
    return [
    	'user_id' => function() {
    		return factory('App\User')->create()->id;
    	},
    	'team_id' => function() {
    		return factory('App\Team')->create()->id;
    	},
    	'image_url' => $faker->imageUrl,
        'description' => $faker->paragraph
    ];
});
