<?php

namespace App\Models\Clients;

use App\Models\Commons\Address;
use App\Models\Commons\Contact;
use App\Traits\ClientsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
	use SoftDeletes;
	use ClientsTrait;
	public $timestamps = true;
	protected $fillable = [
		'address_id',
		'contact_id',
		'type',
		'cpf',
		'rg',
		'name',
		'sex',
		'birthday',
		'cnpj',
		'ie',
		'isention_ie',
		'fantasy_name',
		'company_name',
		'foundation',
	];


	static public function getAlltoSelectList()
	{
		return self::get()->map(function($s){
			return [
				'id'            => $s->id,
				'description'   => $s->getShortName()
			];
		})->pluck('description', 'id');
	}

	public function getResponsibleName()
	{
		return ($this->attributes['name'] != "") ? $this->getAttribute('name') : "-";
	}

	public function getCompanyName()
	{
		return ($this->attributes['company_name'] != "") ? $this->getAttribute('company_name') : "-";
	}

	public function getShortName()
	{
		return ($this->attributes['type']) ? $this->getAttribute('company_name') : $this->getAttribute('name');
	}

	public function getShortDocument()
	{
		return ($this->attributes['type']) ? $this->getFormattedCnpj() : $this->getFormattedCpf();
	}
	public function getClientIe()
	{
		return ($this->attributes['isention_ie']) ? 'Isento' : $this->getFormattedIe();
	}


	// ******************** RELASHIONSHIP ******************************
	public function address()
	{
		return $this->belongsTo(Address::class, 'address_id');
	}
	public function contact()
	{
		return $this->belongsTo(Contact::class, 'contact_id');
	}
	public function units()
	{
		return $this->hasMany(Unit::class, 'client_id');
	}
}