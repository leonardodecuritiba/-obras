<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Users\Collaborator::class, function (Faker $faker) {
	return [
		'user_id'       => function () {
			return factory( \App\Models\Users\User::class )->create()->id;
		},
		'description'     => $faker->text(50),
	];
});
