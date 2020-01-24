<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Commons\Product::class, function (Faker $faker) {
    return [
	    'unit_id'       => $faker->numberBetween( $min = 1, $max = 5 ),
	    'code'          => $faker->randomNumber(4),
	    'name'          => $faker->text(20),
	    'description'   => $faker->text(100),
    ];
});
