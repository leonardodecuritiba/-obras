<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
	use Notifiable;
	use EntrustUserTrait{ restore as private restoreA; } // add this trait to your user model
	use SoftDeletes { restore as private restoreB; }

	public function restore()
	{
		$this->restoreA();
		$this->restoreB();
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	public function getShortName()
	{
		$name = $this->getAttribute('name');
		if (strlen ( $name ) > 20){
			$names = explode(' ',$name);
			$name = $names[0];
		}
		return $name;
	}

	public function getShortRoleName()
	{
		return $this->getRole()->display_name;
	}

	public function getRole()
	{
		return $this->roles()->first();
	}
	// ******************** RELASHIONSHIP ******************************

	public function collaborator()
	{
		return $this->hasOne(Collaborator::class, 'user_id');
	}
}
