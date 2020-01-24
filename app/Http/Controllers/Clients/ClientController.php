<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\ClientRequest;
use App\Models\Clients\Client;
use App\Models\Commons\CepStates;
use Illuminate\Routing\Route;

class ClientController extends Controller
{
	public $entity = "clients";
	public $sex = "M";
	public $name = "Cliente";
	public $names = "Clientes";
	public $route = "clients";
	public $main_folder = 'pages.clients';
	public $PageResponse;

	public function __construct(Route $route) {
		$this->PageResponse = (object) [
			'page_title'     => $this->names,
			'page_noresults' => '',
			'main_title'     => '',
			'entity'         => $this->entity,
			'route'          => $this->route,
			'main_folder'    => $this->main_folder,
			'name'           => $this->name,
			'names'          => $this->names,
			'sex'            => $this->sex,
			'response'       => array(),
			'auxiliar'       => array(),
			'tab'            => 'data',
			'breadcrumb'     => array(),
		];
		$this->breadcrumb($route);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $this->PageResponse->response   = Client::all();
	    return view( $this->main_folder . '.index' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $this->PageResponse->auxiliar['states'] = CepStates::getAlltoSelectList( [ 'id', 'description' ] );
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Clients\ClientRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( ClientRequest $request)
    {
	    $client = Client::create($request->all());
	    return response()->success('STORE', $this, [$this->route.'.edit', $client->id], $client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
	    $this->PageResponse->auxiliar['states'] = CepStates::getAlltoSelectList( [ 'id', 'description' ] );
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $client );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Clients\ClientRequest  $request
     * @param  \App\Models\Clients\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function update( ClientRequest $request, Client $client)
    {
	    $client->update($request->all());
	    return response()->success('UPDATE', $this, [$this->route.'.edit', $client->id], $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
	    $client->delete();
	    return 1;
    }
}
