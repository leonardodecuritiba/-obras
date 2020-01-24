<?php

namespace App\Observers\Commons;

use App\Models\Commons\Group;
use Illuminate\Http\Request;

class GroupObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}


	/**
	 * Listen to the Group deleting event.
	 *
	 * @param  \App\Models\Commons\Group $group
	 *
	 * @return void
	 */
	public function deleting( Group $group)
	{
		foreach($group->subgroups as $subgroup) $subgroup->delete();
	}
}