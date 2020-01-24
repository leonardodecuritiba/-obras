<?php

namespace App\Models\Clients;

use App\Models\Commons\Requisition;
use App\Traits\ClientsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
	use SoftDeletes;
	use ClientsTrait;
	public $timestamps = true;
	protected $fillable = [
		'unit_id',
		'name',
		'descriptions'
	];


	static public function getAlltoSelectList()
	{
		return self::get()->map(function($s){
			return [
				'id'            => $s->id,
				'description'   => $s->name
			];
		})->pluck('description', 'id');
	}

	public function getShortName()
	{
		return $this->getAttribute('name');
	}

	public function getClientShortName()
	{
		return $this->unit->getClientShortName();
	}

	public function getClientShortDocument()
	{
		return $this->unit->getClientShortDocument();
	}

	public function getClientIe()
	{
		return $this->unit->getClientIe();
	}

	public function getClientId()
	{
		return $this->unit->getClientId();
	}
	public function getUnitFullAddress()
	{
		return $this->unit->getFullAddress();
	}
	// ******************** RELASHIONSHIP ******************************
	public function unit()
	{
		return $this->belongsTo(Unit::class, 'unit_id');
	}
	public function requisitions()
	{
		return $this->hasMany(Requisition::class, 'job_id');
	}
}











