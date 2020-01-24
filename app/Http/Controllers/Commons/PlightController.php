<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\PlightRequest;
use App\Models\Commons\Plight;
use Illuminate\Routing\Route;

class PlightController extends Controller
{
	public $entity = "plights";
	public $sex = "M";
	public $name = "Empenho";
	public $names = "Empenhos";
	public $route = "plights";
	public $main_folder = 'pages.plights';
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
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>NULL,'text'=> $this->names]
		];
		$this->PageResponse->response   = Plight::all();
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
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.CREATE', [ 'name' => $this->name ])],
		];
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\PlightRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PlightRequest $request)
	{
		Plight::create( $request->all() );
		return response()->success( 'STORE', $this, $this->route . '.index' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Commons\Plight $plight
	 * @return \Illuminate\Http\Response
	 */
	public function show(Plight $plight)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Commons\Plight  $plight
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Plight $plight)
	{
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
		];
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse )
			->with( 'Data', $plight );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\PlightRequest $request
	 * @param  \App\Models\Commons\Plight  $plight
	 * @return \Illuminate\Http\Response
	 */
	public function update(PlightRequest $request, Plight $plight)
	{
		$plight->update($request->all());
		return response()->success('UPDATE', $this, $this->route.'.index', $plight);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Commons\Plight  $plight
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Plight $plight)
	{
		$plight->delete();
		return 1;
	}
}
