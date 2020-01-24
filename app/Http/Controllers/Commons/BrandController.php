<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\BrandRequest;
use App\Models\Commons\Brand;
use Illuminate\Routing\Route;

class BrandController extends Controller
{
	public $entity = "brands";
	public $sex = "F";
	public $name = "Marca";
	public $names = "Marcas";
	public $route = "brands";
	public $main_folder = 'pages.brands';
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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->PageResponse->response   = Brand::all();
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
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\BrandRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BrandRequest $request)
	{
		Brand::create($request->all());
		return response()->success('UPDATE', $this, $this->route.'.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Commons\Brand  $brand
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Commons\Brand  $brand
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Brand $brand)
	{
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse )
			->with( 'Data', $brand );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\BrandRequest  $request
	 * @param  \App\Models\Commons\Brand  $brand
	 * @return \Illuminate\Http\Response
	 */
	public function update(BrandRequest $request, Brand $brand)
	{
		$brand->update($request->all());
		return response()->success('UPDATE', $this, $this->route.'.index', $brand);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Commons\Brand  $brand
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Brand $brand)
	{
		$brand->delete();
		return 1;
	}
}
