<?php

namespace App\Models\Commons;

use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plight extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'name'
	];

	public function getShortName()
	{
		return $this->getAttribute('name');
	}

	// ******************** RELASHIONSHIP ******************************
	public function requisitions()
	{
		return $this->hasMany(Requisition::class, 'plight_id');
	}
}