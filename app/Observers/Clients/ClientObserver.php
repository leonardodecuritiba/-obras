<?php

namespace App\Observers\Clients;

use App\Models\Clients\Client;
use App\Models\Commons\Address;
use App\Models\Commons\Contact;
use Illuminate\Http\Request;

class ClientObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Client creating event.
	 *
	 * @param  \App\Models\Clients\Client $client
	 *
	 * @return void
	 */
	public function creating( Client $client )
	{
		$contact = Contact::create($this->request->all());
		$address = Address::create($this->request->all());
		$client->contact_id = $contact->id;
		$client->address_id = $address->id;
	}

	/**
	 * Listen to the Client updating event.
	 *
	 * @param  \App\Models\Clients\Client $client
	 *
	 * @return void
	 */
	public function saving( Client $client)
	{
		if($client->address != NULL){
			$client->address->update($this->request->all());
			$client->contact->update($this->request->all());
		}
	}

	/**
	 * Listen to the Client deleting event.
	 *
	 * @param  \App\Models\Clients\Client $client
	 *
	 * @return void
	 */
	public function deleting( Client $client)
	{
		$client->address->delete();
		$client->contact->delete();
		foreach($client->units as $unit) $unit->delete();
	}
}