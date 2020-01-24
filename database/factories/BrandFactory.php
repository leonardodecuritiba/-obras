<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Commons\Brand::class, function (Faker $faker) {
	return [
		'name'          => $faker->text( 20 ),
	];
});
