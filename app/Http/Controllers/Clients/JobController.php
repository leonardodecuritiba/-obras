<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use App\Models\Clients\Job;
use App\Models\Clients\Unit;
use App\Models\Commons\CepStates;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class JobController extends Controller
{
	public $entity = "jobs";
	public $sex = "F";
	public $name = "Obra";
	public $names = "Obras";
	public $route = "jobs";
	public $main_folder = 'pages.jobs';
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
	 * @param  $unit_id
	 * @return \Illuminate\Http\Response
	 */
	public function create($unit_id)
	{
		$unit = Unit::findOrFail($unit_id);
		$this->PageResponse->auxiliar['unit_id'] = $unit_id;
		$this->PageResponse->auxiliar['states'] = CepStates::getAlltoSelectList( [ 'id', 'description' ] );
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route('clients.index'),'text'=>'Clientes'],
			['route'=>route('clients.edit',$unit->client_id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Cliente' ])],
			['route'=>route('units.edit',$unit->id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Unidade' ])],
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
	    $job = Job::create($request->all());
	    return response()->success( 'STORE', $this, ['units.edit', $job->unit_id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
	    $this->PageResponse->auxiliar['states'] = CepStates::getAlltoSelectList( [ 'id', 'description' ] );
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route('clients.index'),'text'=>'Clientes'],
		    ['route'=>route('clients.edit',$job->unit->client_id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Cliente' ])],
		    ['route'=>route('units.edit',$job->unit_id),'text'=> trans('pages.view.EDIT', [ 'name' => 'Unidade' ])],
		    ['route'=>NULL,'text'=>trans('pages.view.EDIT', [ 'name' => $this->name])],
	    ];
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $job );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
	    $job->update($request->all());
	    return response()->success('UPDATE', $this, ['units.edit', $job->unit_id], $job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
	    $job->delete();
	    return 1;
    }
}
