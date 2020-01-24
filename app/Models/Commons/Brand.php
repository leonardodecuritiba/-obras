<?php

namespace App\Models\Commons;

use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
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

}
