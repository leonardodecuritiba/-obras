<?php

namespace App\Models\Commons;

use App\Models\Products\Product;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetricUnit extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'code',
		'description'
	];

	// ******************** RELASHIONSHIP ******************************
	public function product()
	{
		return $this->hasMany(Product::class, 'unit_id');
	}
}
