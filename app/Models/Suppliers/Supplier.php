<?php

namespace App\Models\Suppliers;

use App\Models\Commons\Address;
use App\Models\Commons\Contact;
use App\Models\Commons\Requisition;
use App\Models\Commons\RequisitionProduct;
use App\Traits\ClientsTrait;
use App\Traits\SuppliersTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
	use SoftDeletes;
	use ClientsTrait;
	use SuppliersTrait;
	public $timestamps = true;
	protected $fillable = [
		'address_id',
		'contact_id',
		'cnpj',
		'ie',
		'isention_ie',
		'fantasy_name',
		'company_name',
		'foundation',
		'favored_cnpj',
		'favored_cpf',
		'favored_name',
		'bank',
		'agency',
		'account',
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

	public function getFavoredName()
	{
		return ($this->attributes['favored_name'] != "") ? $this->getAttribute('favored_name') : "-";
	}

	public function getCompanyName()
	{
		return ($this->attributes['company_name'] != "") ? $this->getAttribute('company_name') : "-";
	}

	public function getShortName()
	{
		return $this->getAttribute('company_name');
	}

	public function getFullAddress()
	{
		return $this->address->getFullAddress();
	}

	public function getShortDocument()
	{
		return $this->getFormattedCnpj();
	}

	public function getIe()
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
	public function requisition_products()
	{
		return $this->hasMany(RequisitionProduct::class, 'supplier_id');
	}
}











