<?php

namespace App\Observers\Suppliers;

use App\Models\Suppliers\Supplier;
use App\Models\Commons\Address;
use App\Models\Commons\Contact;
use Illuminate\Http\Request;

class SupplierObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Supplier creating event.
	 *
	 * @param  \App\Models\Suppliers\Supplier $supplier
	 *
	 * @return void
	 */
	public function creating( Supplier $supplier )
	{
		$contact = Contact::create($this->request->all());
		$address = Address::create($this->request->all());
		$supplier->contact_id = $contact->id;
		$supplier->address_id = $address->id;
	}

	/**
	 * Listen to the Supplier updating event.
	 *
	 * @param  \App\Models\Suppliers\Supplier $supplier
	 *
	 * @return void
	 */
	public function saving( Supplier $supplier)
	{
		if($supplier->address != NULL){
			$supplier->address->update($this->request->all());
			$supplier->contact->update($this->request->all());
		}
	}

	/**
	 * Listen to the Supplier deleting event.
	 *
	 * @param  \App\Models\Suppliers\Supplier $supplier
	 *
	 * @return void
	 */
	public function deleting( Supplier $supplier)
	{
		$supplier->address->delete();
		$supplier->contact->delete();
	}
}