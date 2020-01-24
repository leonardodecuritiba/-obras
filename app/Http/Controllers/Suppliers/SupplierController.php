<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\SupplierRequest;
use App\Models\Suppliers\Supplier;
use App\Models\Commons\CepStates;
use App\Models\Commons\Plight;
use Illuminate\Routing\Route;

class SupplierController extends Controller
{
	public $entity = "suppliers";
	public $sex = "M";
	public $name = "Fornecedor";
	public $names = "Fornecedores";
	public $route = "suppliers";
	public $main_folder = 'pages.suppliers';
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
		$this->PageResponse->response   = Supplier::all();
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
		$this->PageResponse->auxiliar = [
			'states'    => CepStates::getAlltoSelectList( [ 'id', 'description' ] )
		];
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Suppliers\SupplierRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(SupplierRequest $request)
	{
		$supplier = Supplier::create($request->all());
		return response()->success('STORE', $this, [$this->route.'.edit', $supplier->id], $supplier);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Suppliers\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function show(Supplier $supplier)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Suppliers\Supplier  $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Supplier $supplier)
	{
		$this->PageResponse->auxiliar = [
			'states'    => CepStates::getAlltoSelectList( [ 'id', 'description' ] )
		];
		return view( $this->main_folder . '.master' )
			->with( 'PageResponse', $this->PageResponse )
			->with( 'Data', $supplier );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Suppliers\SupplierRequest $request
	 * @param  \App\Models\Suppliers\Supplier $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function update(SupplierRequest $request, Supplier $supplier)
	{
		$supplier->update($request->all());
		return response()->success('UPDATE', $this, [$this->route.'.edit', $supplier->id], $supplier);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Suppliers\Supplier $supplier
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Supplier $supplier)
	{
		$supplier->delete();
		return 1;
	}
}
