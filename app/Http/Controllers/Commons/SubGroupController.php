<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\SubGroupRequest;
use App\Models\Commons\Group;
use App\Models\Commons\SubGroup;
use Illuminate\Routing\Route;

class SubGroupController extends Controller
{

	public $entity = "sub_groups";
	public $sex = "M";
	public $name = "Sub-Grupo";
	public $names = "Sub-Grupos";
	public $route = "sub_groups";
	public $main_folder = 'pages.sub_groups';
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
	    $this->PageResponse->response   = SubGroup::all();
	    return view( $this->main_folder . '.index' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  $group_id
     * @return \Illuminate\Http\Response
     */
    public function create($group_id = NULL)
    {
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route($this->route . '.index'),'text'=>$this->names],
		    ['route'=>NULL,'text'=> trans('pages.view.CREATE', [ 'name' => $this->name ])],
	    ];
	    $this->PageResponse->auxiliar   = [
		    'groups' => Group::getAlltoSelectList( [ 'id', 'name' ] ),
		    'group_id' => $group_id,
	    ];
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Commons\SubGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubGroupRequest $request)
    {
	    SubGroup::create($request->all());
	    return response()->success( 'STORE', $this, $this->route . '.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commons\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SubGroup $subGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commons\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SubGroup $subGroup)
    {
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route($this->route . '.index'),'text'=>$this->names],
		    ['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
	    ];
	    $this->PageResponse->auxiliar   = [
		    'groups' => Group::getAlltoSelectList( [ 'id', 'name' ] ),
	    ];
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $subGroup );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Commons\SubGroupRequest  $request
     * @param  \App\Models\Commons\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function update(SubGroupRequest $request, SubGroup $subGroup)
    {
	    $subGroup->update($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index', $subGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commons\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubGroup $subGroup)
    {
	    $subGroup->delete();
	    return 1;
    }
}
