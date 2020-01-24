<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Clients\Job::class, function (Faker $faker) {

	return [
		'unit_id'       => $faker->numberBetween( $min = 1, $max = 30 ),
		'name'          => $faker->text( 10 ),
		'descriptions'  => $faker->text( 21 ),
	];
});
