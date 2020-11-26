<?php

use App\Invite;
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

$factory->define(Invite::class, function (Faker $faker) {
    return [
    	'email' => function() {
    		return factory('App\User')->create()->email;
    	},
    	'team_id' => function() {
    		return factory('App\Team')->create()->id;
    	},
    	'token' => Str::random(40)
    ];
});
