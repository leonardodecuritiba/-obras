<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\GroupRequest;
use App\Models\Commons\Group;
use Illuminate\Routing\Route;

class GroupController extends Controller
{
	public $entity = "groups";
	public $sex = "M";
	public $name = "Grupo";
	public $names = "Grupos";
	public $route = "groups";
	public $main_folder = 'pages.groups';
	public $PageResponse;

	public function __construct(Route $route) {
		$this->PageResponse = (object) [
			'page_title'     => $this->names,
			'page_noresults' => 'Nenhum ' . $this->name . ' encontrado!',
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
		$this->PageResponse->response   = Group::all();
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
	 * @param  \App\Http\Requests\Commons\GroupRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(GroupRequest $request)
	{
		Group::create( $request->all() );
		return response()->success( 'STORE', $this, $this->route . '.index' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Commons\Group $group
	 * @return \Illuminate\Http\Response
	 */
	public function show(Group $group)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Commons\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Group $group)
	{
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
		];
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse )
			->with( 'Data', $group );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\GroupRequest $request
	 * @param  \App\Models\Commons\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function update(GroupRequest $request, Group $group)
	{
		$group->update($request->all());
		return response()->success('UPDATE', $this, $this->route.'.index', $group);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Commons\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Group $group)
	{
		$group->delete();
		return 1;
	}
}
