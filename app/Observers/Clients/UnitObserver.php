<?php

namespace App\Observers\Clients;

use App\Models\Clients\Unit;
use App\Models\Commons\Address;
use Illuminate\Http\Request;

class UnitObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Unit creating event.
	 *
	 * @param  \App\Models\Clients\Unit $unit
	 *
	 * @return void
	 */
	public function creating( Unit $unit )
	{
		$address = Address::create($this->request->all());
		$unit->address_id = $address->id;
	}

	/**
	 * Listen to the Unit updating event.
	 *
	 * @param  \App\Models\Clients\Unit $unit
	 *
	 * @return void
	 */
	public function saving( Unit $unit)
	{
		if($unit->address != NULL){
			$unit->address->update($this->request->all());
		}
	}

	/**
	 * Listen to the Unit deleting event.
	 *
	 * @param  \App\Models\Clients\Unit $unit
	 *
	 * @return void
	 */
	public function deleting( Unit $unit)
	{
		$unit->address->delete();
		foreach($unit->jobs as $job) $job->delete();
	}
}