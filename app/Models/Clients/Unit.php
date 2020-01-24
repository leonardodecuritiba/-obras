<?php

namespace App\Models\Clients;

use App\Models\Commons\Address;
use App\Traits\ClientsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;
	use ClientsTrait;
	public $timestamps = true;
	protected $fillable = [
		'address_id',
		'client_id',
		'name',
		'descriptions'
	];

	public function getFullAddress()
	{
		return $this->address->getFullAddress();
	}

	public function getShortName()
	{
		return $this->getAttribute('name');
	}

	public function getClientShortName()
	{
		return $this->client->getShortName();
	}

	public function getClientShortDocument()
	{
		return $this->client->getShortDocument();
	}

	public function getClientIe()
	{
		return $this->client->getClientIe();
	}

	public function getClientId()
	{
		return $this->client->id;
	}
	// ******************** RELASHIONSHIP ******************************
	public function address()
	{
		return $this->belongsTo(Address::class, 'address_id');
	}
	public function client()
	{
		return $this->belongsTo(Client::class, 'client_id');
	}
	public function jobs()
	{
		return $this->hasMany(Job::class, 'unit_id');
	}
}