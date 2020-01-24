<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Commons\SubGroup::class, function (Faker $faker) {
	return [
		'group_id'=> $faker->numberBetween( $min = 1, $max = 10 ),
		'name' => $faker->text( 20 ),
	];
});
