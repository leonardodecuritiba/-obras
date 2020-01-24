<?php

namespace App\Models\Commons;

use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'unit_id',
		'code',
		'name',
		'description'
	];


	static public function getAlltoSelectList(array $fields = ['id', 'description'],$api = false)
	{
		$op = self::get()->map(function($s) use ($fields){
			return [
				'id'            => $s->id,
				'description'   => $s->getShortCodeName()
			];
		});
		return ($api) ? $op : $op->pluck('description', 'id');
	}

	public function getThumbPrintImage()
	{
		return ($this->image != NULL) ?
			$this->image->getPrintImage(true) : 'http://placehold.it/' . Picture::_DEFAULT_SIZE_THUMB_[0].'x'.Picture::_DEFAULT_SIZE_THUMB_[1];
	}

	public function getThumbImage()
	{
		return ($this->image != NULL) ?
			$this->image->getImage(true) : 'http://placehold.it/' . Picture::_DEFAULT_SIZE_THUMB_[0].'x'.Picture::_DEFAULT_SIZE_THUMB_[1];
	}

	public function getLinkImage()
	{
		return ($this->image != NULL) ?
			$this->image->getImage(false) : 'http://placehold.it/' . Picture::_DEFAULT_SIZE_[0].'x'.Picture::_DEFAULT_SIZE_[1];
	}

	public function getShortCodeName()
	{
		return $this->getAttribute('code') . ' - ' . $this->getShortName();
	}

	public function getShortName()
	{
		return $this->getAttribute('name');
	}

	public function getUnitName()
	{
		return $this->unit->code;
	}


	// ******************** RELASHIONSHIP ******************************

	public function unit()
	{
		return $this->belongsTo(MetricUnit::class, 'unit_id');
	}

	public function image()
	{
		return $this->hasOne(Picture::class, 'product_id');
	}
}