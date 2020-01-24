<?php

namespace App\Models\Users;

use App\Models\Requisitions\Requisition;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
	use SoftDeletes;
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'user_id',
		'description'
	];

	public function getShortName()
	{
		return $this->user->getShortName();
	}

	public function getEmail()
	{
		return $this->user->email;
	}

	public function getUserName()
	{
		return $this->user->name;
	}

	public function getShortRoleName()
	{
		return $this->user->getShortRoleName();
	}

	// ******************** RELASHIONSHIP ******************************
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function author_requisitions()
	{
		return $this->hasMany(Requisition::class, 'author_id');
	}

	public function buyer_requisitions()
	{
		return $this->hasMany(Requisition::class, 'buyer_id');
	}

	public function approver_requisitions()
	{
		return $this->hasMany(Requisition::class, 'approver_id');
	}
}
