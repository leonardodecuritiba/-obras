<?php

/*
|--------------------------------------------------------------------------
| Models Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Models factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

/*
|--------------------------------------------------------------------------
| Entities Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\LegalPerson::class, function ( Faker\Generator $faker ) {
	return [
		'idtributation' => $faker->numberBetween($min = 1, $max = 3),
		'cnpj' => $faker->cnpj(false),
		'situation' => NULL,
		'company_name' => $faker->company,
		'fantasy_name' => $faker->company,
		'suframa' => $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 6),
		'foundation' => $faker->date($format = 'd/m/Y', $max = 'now')
	];
});

$factory->define( App\Models\Entities\NaturalPerson::class, function ( Faker\Generator $faker ) {
	return [
		'idcivil_status'      => $faker->numberBetween($min = 1, $max = 6),
		'cpf'                 => $faker->cpf(false),
		'rg'                  => $faker->rg(false),
		'situation'           => NULL,
		'name'                => $faker->name,
		'nickname'            => $faker->userName,
		'issuing_agency'      => $faker->word,
		'idissuing_agency_uf' => $faker->numberBetween( $min = 1, $max = 27 ),
		//randomElement($array = array('PR','SP','RJ')),
		'issue_date'          => $faker->date($format = 'd/m/Y', $max = 'now'),
		'sex'                 => $faker->boolean(),
		'birthday'            => $faker->date($format = 'd/m/Y', $max = 'now'),
		'birth_city'          => $faker->city,
		'idbirth_state'       => $faker->numberBetween( $min = 1, $max = 27 ),
		'spouse'              => $faker->name,
		'father'              => $faker->name,
		'mother'              => $faker->name,
	];
});

$factory->defineAs( \App\Models\Entities\Entity::class, 'natural', function ( Faker\Generator $faker ) {
	$emails    = $faker->freeEmail . ';' . $faker->freeEmail . ';' . $faker->freeEmail;
	$idregion  = $faker->numberBetween( $min = 0, $max = 1 );
	$idroute   = $faker->numberBetween( $min = 0, $max = 1 );
	$idsegment = $faker->numberBetween( $min = 0, $max = 4 );
	$idtype    = $faker->numberBetween( $min = 0, $max = 1 );
	return [
		'idlegal_person'   => null,
		'idnatural_person' => function () {
			return factory( \App\Models\Entities\NaturalPerson::class )->create()->id;
		},
		'idregion'         => ( $idregion == 0 ) ? null : $idregion,
		'idroute'          => ( $idroute == 0 ) ? null : $idroute,
		'idsegment'        => ( $idsegment == 0 ) ? null : $idsegment,
		'idtype'           => ( $idtype == 0 ) ? null : $idtype,
		'isclient'         => $faker->boolean(),
		'im'               => $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'ie'               => $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'cellphone'        => $faker->areaCode() . $faker->cellphone(false, true),
		'commercial_phone' => $faker->areaCode() . $faker->landline(false),
		'emails'           => $emails,
		'date_due'         => $faker->numberBetween( $min = 5, $max = 15 ),
		'date_tolerance'   => $faker->numberBetween( $min = 5, $max = 15 ),
		'inactive'         => $faker->boolean(),
		'observations'     => $faker->text( 500 ),
	];
});

$factory->defineAs( \App\Models\Entities\Entity::class, 'legal', function ( Faker\Generator $faker ) {
	$emails    = $faker->freeEmail . ';' . $faker->freeEmail . ';' . $faker->freeEmail;
	$idregion  = $faker->numberBetween( $min = 0, $max = 1 );
	$idroute   = $faker->numberBetween( $min = 0, $max = 1 );
	$idsegment = $faker->numberBetween( $min = 0, $max = 4 );
	$idtype    = $faker->numberBetween( $min = 0, $max = 1 );
	return [
		'idnatural_person' => NULL,
		'idlegal_person'   => function () {
			return factory( \App\Models\Entities\LegalPerson::class )->create()->id;
		},
		'idregion'         => ( $idregion == 0 ) ? null : $idregion,
		'idroute'          => ( $idroute == 0 ) ? null : $idroute,
		'idsegment'        => ( $idsegment == 0 ) ? null : $idsegment,
		'idtype'           => ( $idtype == 0 ) ? null : $idtype,
		'isclient'         => $faker->boolean(),
		'im'               => $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'ie'               => $faker->randomNumber($nbDigits = 4) . $faker->randomNumber($nbDigits = 9),
		'cellphone'        => $faker->areaCode() . $faker->cellphone(false, true),
		'commercial_phone' => $faker->areaCode() . $faker->landline(false),
		'emails'           => $emails,
		'date_due'         => $faker->numberBetween( $min = 5, $max = 15 ),
		'date_tolerance'   => $faker->numberBetween( $min = 5, $max = 15 ),
		'inactive'         => $faker->boolean(),
		'observations'     => $faker->text( 500 ),
	];
});

/*
|--------------------------------------------------------------------------
| References Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Reference::class, function ( Faker\Generator $faker ) {
	return [
		'name' => $faker->company,
		'phone' => $faker->areaCode() . $faker->landline(false),
	];
});
/*
|--------------------------------------------------------------------------
| Histories Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\History::class, function ( Faker\Generator $faker ) {
	return [
		'identity'    => $faker->numberBetween( $min = 1, $max = 20 ),
		'description' => $faker->text(500),
	];
});
/*
|--------------------------------------------------------------------------
| Authorizeds Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Authorized::class, function ( Faker\Generator $faker ) {
	return [
		'identity' => $faker->numberBetween( $min = 1, $max = 20 ),
		'name'     => $faker->name,
		'cpf'      => $faker->cpf(false),
		'rg'       => $faker->rg(false),
		'office'   => $faker->company,
		'address'  => $faker->address,
	];
});
/*
|--------------------------------------------------------------------------
| Dependents Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Dependent::class, function ( Faker\Generator $faker ) {
	return [
		'identity'       => $faker->numberBetween( $min = 1, $max = 20 ),
		'idrelationship' => $faker->numberBetween($min = 1, $max = 2),
		'name'           => $faker->name,
		'birthday'       => $faker->date($format = 'd/m/Y', $max = 'now'),
	];
});
/*
|--------------------------------------------------------------------------
| Guarantors Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Guarantor::class, function ( Faker\Generator $faker ) {
	return [
		'identity'    => $faker->numberBetween( $min = 1, $max = 20 ),
		'idguarantor' => $faker->numberBetween($min = 1, $max = 20),
	];
});
/*
|--------------------------------------------------------------------------
| Financials Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Financial::class, function ( Faker\Generator $faker ) {
	return [
		'identity'       => $faker->numberBetween( $min = 1, $max = 20 ),
		'idbank'         => $faker->numberBetween($min = 8, $max = 30),
		'idaccount_type' => $faker->numberBetween($min = 1, $max = 2),
		'agency'         => $faker->text(10),
		'account_number' => $faker->randomNumber(5),
		'special'        => $faker->boolean(),
		'phone'          => $faker->areaCode() . $faker->landline(false),
		'manager_name'   => $faker->name,
		'observations'   => $faker->text(500),
	];
});
/*
|--------------------------------------------------------------------------
| Works Factories
|--------------------------------------------------------------------------
 */
$factory->define( App\Models\Entities\Work::class, function ( Faker\Generator $faker ) {
	$income = $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 10000);
	$extra_income = $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 10000);
	return [
		'identity'       => $faker->numberBetween( $min = 1, $max = 20 ),
		'work_types'     => $faker->randomElements($array = array ('1','2','3','4'), $count = $faker->numberBetween($min = 1, $max = 4)),
		'company'        => $faker->company,
		'phone'          => $faker->areaCode() . $faker->landline(false),
		'occupation'     => $faker->name,
		'function'       => $faker->name,
		'income'         => $income,
		'extra_income'   => $extra_income,
		'total_income'   => $income + $extra_income,
		'admission_date' => $faker->date($format = 'd/m/Y', $max = 'now'),
		'observations'   => $faker->text(500),
	];
});
/*
|--------------------------------------------------------------------------
| Address Factories
|--------------------------------------------------------------------------
 */
$factory->define( \App\Models\Entities\Address::class, function ( Faker\Generator $faker ) {
	$state = $faker->numberBetween( $min = 1, $max = 27 );
	return [
		'zip'        => $faker->randomNumber( $nbDigits = 8 ),
		'idstate'    => $state,
		'city'       => $faker->city,
		'district'   => $faker->streetName,
		'street'     => $faker->streetName,
		'number'     => $faker->randomNumber( $nbDigits = 4 ),
		'complement' => $faker->word
	];
});