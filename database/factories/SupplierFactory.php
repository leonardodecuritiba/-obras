<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Suppliers\Supplier::class, function (Faker $faker) {
	$isention_ie = $faker->boolean();
	return [
		'address_id'       => function () {
			return factory( \App\Models\Commons\Address::class )->create()->id;
		},
		'contact_id'       => function () {
			return factory( \App\Models\Commons\Contact::class )->create()->id;
		},
		'cnpj'             => $faker->cnpj(false),
		'ie'               => ($isention_ie) ? '' : $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'isention_ie'       => $isention_ie,
		'fantasy_name'     => $faker->company,
		'company_name'     => $faker->company,
		'foundation'       => ($faker->boolean()) ? $faker->date($format = 'd/m/Y', $max = 'now') : NULL,

		'favored_cpf'      => $faker->cpf(false),
		'favored_cnpj'     => $faker->cnpj(false),
		'favored_name'     => $faker->name,

		'bank'             => $faker->bank,
		'agency'           => $faker->randomNumber($nbDigits = 5),
		'account'          => $faker->randomNumber($nbDigits = 8),
	];
});