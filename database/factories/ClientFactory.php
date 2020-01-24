<?php

use Faker\Generator as Faker;

$factory->defineAs( \App\Models\Clients\Client::class, 'natural', function ( Faker $faker ) {
	return [
		'address_id'       => function () {
			return factory( \App\Models\Commons\Address::class )->create()->id;
		},
		'contact_id'       => function () {
			return factory( \App\Models\Commons\Contact::class )->create()->id;
		},
		'type'             => 0,
		'cpf'              => $faker->cpf(false),
		'rg'               => $faker->rg(false),
		'name'             => $faker->name,
		'sex'              => $faker->boolean(),
		'birthday'         => $faker->date($format = 'd/m/Y', $max = 'now'),
	];
});

$factory->defineAs( \App\Models\Clients\Client::class, 'legal', function ( Faker $faker ) {
	$isention_ie = $faker->boolean();
	return [
		'address_id'       => function () {
			return factory( \App\Models\Commons\Address::class )->create()->id;
		},
		'contact_id'       => function () {
			return factory( \App\Models\Commons\Contact::class )->create()->id;
		},
		'type'             => 1,
		'cnpj'             => $faker->cnpj(false),
		'ie'               => ($isention_ie) ? '' : $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'isention_ie'       => $isention_ie,
		'fantasy_name'     => $faker->company,
		'company_name'     => $faker->company,
		'foundation'       => ($faker->boolean()) ? $faker->date($format = 'd/m/Y', $max = 'now') : NULL,
	];
});