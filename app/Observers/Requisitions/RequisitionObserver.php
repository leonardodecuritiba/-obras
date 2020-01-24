<?php

namespace App\Observers\Requisitions;

use App\Models\Requisitions\Requisition;
use Illuminate\Http\Request;

class RequisitionObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Group deleting event.
	 *
	 * @param  \App\Models\Requisitions\Requisition $requisition
	 *
	 * @return void
	 */
	public function deleting( Requisition $requisition)
	{
		$requisition->requisition_budgets->each( function ( $w ) {
            $w->delete();
        } );
	}
}