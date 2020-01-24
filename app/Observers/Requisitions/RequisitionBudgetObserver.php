<?php

namespace App\Observers\Requisitions;

use App\Models\Requisitions\RequisitionBudget;
use Illuminate\Http\Request;

class RequisitionBudgetObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Group deleting event.
	 *
	 * @param  \App\Models\Requisitions\RequisitionBudget $requisition_budget
	 *
	 * @return void
	 */
	public function deleting( RequisitionBudget $requisition_budget)
	{
        optional($requisition_budget->requisition_buy)->delete();
	}
}