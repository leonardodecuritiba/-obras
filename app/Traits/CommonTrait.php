<?php

namespace App\Traits;

use App\Helpers\DataHelper;

trait CommonTrait
{

	public function getCreatedAtTimestamp()
	{
		return DataHelper::getTimestamp($this->attributes['created_at']);
	}

	public function getCreatedAtAttribute($value)
	{
		return DataHelper::getPrettyDateTime($value);
	}

	public function getShortName()
	{
		return $this->getAttribute('name');
	}

	static public function getAlltoSelectList(array $fields = ['id', 'description'],$api = false)
	{
		$op = self::get()->map(function($s) use ($fields){
			return [
				'id'            => $s->{$fields[0]},
				'description'   => $s->{$fields[1]}
			];
		});
		return ($api) ? $op : $op->pluck('description', 'id');
	}
}