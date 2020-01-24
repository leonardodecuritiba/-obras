<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Models\Clients\Job;
use App\Models\Clients\Unit;
use App\Models\Commons\CepCities;
use App\Models\Commons\SubGroup;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller
{
	/**
	 * gET the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getStateCityToSelect()
	{
		$idstate = Input::get('id');
		return ($idstate == NULL) ? $idstate : CepCities::where('idstate',$idstate)->get();
	}
	/**
	 * get the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getClientUnitsToSelect()
	{
		$client_id = Input::get('id');
		return ($client_id == NULL) ? $client_id : Unit::where('client_id',$client_id)->get();
	}
	/**
	 * get the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getUnitJobsToSelect()
	{
		$unit_id = Input::get('id');
		return ($unit_id == NULL) ? $unit_id : Job::where('unit_id',$unit_id)->get();
	}
	/**
	 * get the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getCLientJobsToSelect()
	{
		$client_id = Input::get('id');
		if($client_id == NULL) return $client_id;
		$unit_ids = Unit::where('client_id',$client_id)->pluck('id');
		return ($unit_ids == NULL) ? $unit_ids : Job::whereIn('unit_id',$unit_ids)->get()->map(function($p){
			$p->text = $p->unit->name . ' / ' . $p->name;
			return $p;
		});
	}
	/**
	 * get the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getGroupsSubgroupsToSelect()
	{
		$group_id = Input::get('id');
		if($group_id == NULL) return $group_id;
		return $subgroup = SubGroup::where('group_id',$group_id)->get()->map(function($p){
			$p->text = $p->name;
			return $p;
		});
	}
}
