<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Commons\Group::class, function (Faker $faker) {
	return [
		'name' => $faker->text( 20 ),
	];
});
