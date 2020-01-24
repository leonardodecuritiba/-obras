<?php

namespace App\Observers\Commons;

use App\Models\Commons\Brand;
use Illuminate\Http\Request;

class BrandObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}


	/**
	 * Listen to the Group deleting event.
	 *
	 * @param  \App\Models\Commons\Brand $brand
	 *
	 * @return void
	 */
	public function deleting( Brand $brand)
	{
//		foreach($brand->subgroups as $subgroup) $subgroup->delete();
	}
}