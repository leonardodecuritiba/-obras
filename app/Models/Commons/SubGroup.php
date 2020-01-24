<?php

namespace App\Models\Commons;

use App\Models\Products\Product;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubGroup extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'group_id',
		'name'
	];

	// ******************** RELASHIONSHIP ******************************

	public function group()
	{
		return $this->belongsTo(Group::class, 'group_id');
	}
	public function requisitions()
	{
		return $this->hasMany(Requisition::class, 'subgroup_id');
	}
}
