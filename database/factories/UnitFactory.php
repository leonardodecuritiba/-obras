<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Clients\Unit::class, function (Faker $faker) {
    return [
	    'client_id'       => $faker->numberBetween( $min = 1, $max = 25 ),
	    'address_id'      => function () {
		    return factory( \App\Models\Commons\Address::class )->create()->id;
	    },
	    'name'          => $faker->text( 10 ),
	    'descriptions'  => $faker->text( 30 ),
    ];
});
