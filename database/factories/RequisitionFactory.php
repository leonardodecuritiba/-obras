<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Requisitions\Requisition::class, function (Faker $faker) {
	$status = $faker->numberBetween( $min = 1, $max = 5);
    return [
	    'job_id'            => $faker->numberBetween( $min = 1, $max = 50 ),
	    'author_id'         => $faker->numberBetween( $min = 1, $max = 5 ),
	    'group_id'          => $faker->numberBetween( $min = 1, $max = 5 ),
	    'subgroup_id'       => $faker->numberBetween( $min = 1, $max = 10 ),
	    'supplier_id'       => $faker->numberBetween( $min = 1, $max = 20 ),
	    'plight_id'         => $faker->numberBetween( $min = 1, $max = 5 ),
	    'doc_type'          => $faker->numberBetween( $min = 0, $max = 3 ),
	    'parcelas'          => $faker->numberBetween( $min = 0, $max = 5 ),
	    'due'               => ($status >= 3) ? $faker->dateTimeThisYear($max = 'now')->format('d/m/Y') : NULL,
	    'status_id'         => $status,
	    'payment_status_id' => ($status == 5) ? 2 : 1,
	    'request_at'        => ($status >= 1) ? $faker->dateTimeThisYear($max = 'now') : NULL,
	    'closed_at'         => ($status > 1) ? $faker->dateTimeThisYear($max = 'now') : NULL,
	    'approved_at'       => ($status > 2) ? $faker->dateTimeThisYear($max = 'now') : NULL,
	    'buy_at'            => ($status > 3) ? $faker->dateTimeThisYear($max = 'now') : NULL,
	    'delivered_at'      => ($status > 4) ? $faker->dateTimeThisYear($max = 'now') : NULL,
	    'document_number'      => ($status > 3) ? $faker->numberBetween(10000,10000000) : NULL,
	    'main_descriptions'      => $faker->text( 500 ),
    ];
});