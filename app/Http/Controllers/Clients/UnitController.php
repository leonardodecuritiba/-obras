<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use App\Models\Clients\Unit;
use App\Models\Commons\CepStates;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UnitController extends Controller
{
	public $entity = "units";
	public $sex = "F";
	public $name = "Unidade";
	public $names = "Unidades";
	public $route = "units";
	public $main_folder = 'pages.units';
	public $PageResponse;

	public function __construct(Route $route) {
		$this->PageResponse = (object) [
			'page_title'     => $this->names,
			'page_noresults' => 'Nenhuma ' . $this->name . ' encontrada!',
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
		];
		$this->breadcrumb($route);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param  $client_id
     * @return \Illuminate\Http\Response
     */
    public function create($client_id)
    {
	    $this->PageResponse->auxiliar = [
	    	'client_id' => $client_id,
	    	'states' => CepStates::getAlltoSelectList( [ 'id', 'description' ] ),
	    ];
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route('clients.index'),'text'=>'Clientes'],
		    ['route'=>route('clients.edit',$client_id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Cliente' ])],
		    ['route'=>NULL,'text'=>trans('pages.view.CREATE', [ 'name' => $this->name])],
	    ];
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $unit = Unit::create($request->all());
	    return response()->success( 'STORE', $this, ['clients.edit', $unit->client_id] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
	    $this->PageResponse->auxiliar['states'] = CepStates::getAlltoSelectList( [ 'id', 'description' ] );
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route('clients.index'),'text'=>'Clientes'],
		    ['route'=>route('clients.edit',$unit->client_id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Cliente' ])],
		    ['route'=>NULL,'text'=>trans('pages.view.EDIT', [ 'name' => $this->name])],
	    ];
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $unit );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
	    $unit->update($request->all());
	    return response()->success('UPDATE', $this, ['clients.edit', $unit->client_id], $unit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
	    $unit->delete();
	    return 1;
    }
}
