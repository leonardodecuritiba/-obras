<?php

namespace App\Models\Commons;

use App\Models\Products\Product;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'name'
	];

	// ******************** RELASHIONSHIP ******************************

	public function subgroups()
	{
		return $this->hasMany(SubGroup::class, 'group_id');
	}

	public function requisitions()
	{
		return $this->hasMany(Requisition::class, 'group_id');
	}
}
