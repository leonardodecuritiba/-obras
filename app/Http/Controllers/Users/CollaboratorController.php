<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CollaboratorRequest;
use App\Models\Users\Collaborator;
use App\Models\Users\Role;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CollaboratorController extends Controller
{
	public $entity = "collaborators";
	public $sex = "M";
	public $name = "Funcionário";
	public $names = "Funcionários";
	public $route = "collaborators";
	public $main_folder = 'pages.collaborators';
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
		$this->PageResponse->response   = Collaborator::with('user')->get();
		return response()->return( $this->main_folder . '.index', $this->PageResponse );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->PageResponse->auxiliar   = [
			'roles' => Role::getAlltoSelectList(),
		];
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.CREATE', [ 'name' => $this->name ])],
		];
		return response()->return( $this->main_folder . '.master', $this->PageResponse );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Users\CollaboratorRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CollaboratorRequest $request)
	{
		Collaborator::create( $request->all() );
		return response()->success( 'STORE', $this, $this->route . '.index' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Users\Collaborator $collaborator
	 * @return \Illuminate\Http\Response
	 */
	public function show(Collaborator $collaborator)
	{
		return $this->edit($collaborator);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Users\Collaborator  $collaborator
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Collaborator $collaborator)
	{
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
		];
		return response()->return( $this->main_folder . '.master', $this->PageResponse, $collaborator );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getMyProfile()
	{
		$this->PageResponse->main_title = trans('pages.view.PROFILE'    );
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.PROFILE')],
		];
		return $this->edit(Auth::user()->collaborator);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Users\CollaboratorRequest $request
	 * @param  \App\Models\Users\Collaborator  $collaborator
	 * @return \Illuminate\Http\Response
	 */
	public function update(CollaboratorRequest $request, Collaborator $collaborator)
	{
		$collaborator->update($request->all());
		return response()->success('UPDATE', $this, $this->route.'.index', $collaborator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Users\Collaborator  $collaborator
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Collaborator $collaborator)
	{
		$collaborator->delete();
		return 1;
	}
}
