<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Commons\Address::class, function (Faker $faker) {
	return [
		'state_id' => $faker->numberBetween( $min = 1, $max = 20 ),
		'city_id' => $faker->numberBetween( $min = 1, $max = 8000 ),
		'zip' => $faker->randomNumber($nbDigits = 8),
		'district' => $faker->streetName,
		'street' => $faker->streetName,
		'number' => $faker->randomNumber($nbDigits = 4),
		'complement' => $faker->word
	];
});
