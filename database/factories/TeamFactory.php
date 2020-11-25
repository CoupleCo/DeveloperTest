<?php

use App\Team;
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

$factory->define(Team::class, function (Faker $faker) {
    return [
    	'owner_id' => function() {
    		return factory('App\User')->create()->id;
    	},
        'name' => $faker->text(30),
        'description' => $faker->paragraph
    ];
});
