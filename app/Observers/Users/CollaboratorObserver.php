<?php

namespace App\Observers\Users;

use App\Models\Users\Collaborator;
use App\Models\Users\User;
use Illuminate\Http\Request;

class CollaboratorObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Client creating event.
	 *
	 * @param  \App\Models\Users\Collaborator $collaborator
	 *
	 * @return void
	 */
	public function creating( Collaborator $collaborator )
	{
		$user = User::create([
			'name' => $this->request->get('name'),
			'email' => $this->request->get('email'),
			'password' => bcrypt($this->request->get('password')),
		]);
		$user->roles()->attach($this->request->get('role_id')); // id only
		$collaborator->user_id = $user->id;
	}

	/**
	 * Listen to the Supplier updating event.
	 *
	 * @param  \App\Models\Users\Collaborator $collaborator
	 *
	 * @return void
	 */
	public function saving( Collaborator $collaborator )
	{
		if($collaborator->user != NULL){
			$usr = [
				'name' => $this->request->get('name'),
				'email' => $this->request->get('email'),
			];
			if($this->request->get('password') != ''){
				$usr['password'] = bcrypt($this->request->get('password'));
			}

			$collaborator->user->update($usr);
		}
	}

	/**
	 * Listen to the Supplier deleting event.
	 *
	 * @param  \App\Models\Users\Collaborator $collaborator
	 *
	 * @return void
	 */
	public function deleting( Collaborator $collaborator )
	{
		$collaborator->user->delete();
		$collaborator->author_requisitions->each(function($r){ $r->delete();});
		$collaborator->buyer_requisitions->each(function($r){ $r->delete();});
		$collaborator->approver_requisitions->each(function($r){$r->delete();});
	}
}