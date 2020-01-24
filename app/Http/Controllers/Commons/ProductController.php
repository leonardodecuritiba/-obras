<?php

namespace App\Http\Controllers\Commons;

use App\Helpers\ExportHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\CreateProductRequest;
use App\Http\Requests\Commons\ProductManageRequest;
use App\Http\Requests\Commons\ProductRequest;
use App\Models\Commons\MetricUnit;
use App\Models\Commons\Picture;
use App\Models\Commons\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Zizaco\Entrust\EntrustFacade;

class ProductController extends Controller
{
	public $entity = "products";
	public $sex = "M";
	public $name = "Produto";
	public $names = "Produtos";
	public $route = "products";
	public $main_folder = 'pages.products';
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


	public function filter(Request $request)
	{
		if(!$request->has('search')){return [];}

		$product = (new Product)->newQuery();
		$fields = ['code','name','description'];

		foreach($fields as $field)
		{
			if ($request->has($field) && ($request->get($field) != '')) {
				$product->where( $field,'like', '%' .  $request->input( $field ).'%' );
			}
		}
		return $product->get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>NULL,'text'=> $this->names]
		];
		$this->PageResponse->response   = $this->filter($request);

		return response()->return( $this->main_folder . '.index', $this->PageResponse );

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Http\Requests\Commons\ProductManageRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function create(ProductManageRequest $request)
	{
		$this->PageResponse->auxiliar   = [
			'units' => MetricUnit::getAlltoSelectList( [ 'id', 'code' ] ),
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
	 * @param  \App\Http\Requests\Commons\ProductRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductRequest $request)
	{
		$product = Product::create( $request->all() );
		$image = $request->file('image');
		if($image != NULL){
			Picture::create([
				'product_id'    => $product->id,
				'filename'      => $image,
				'active'        => 1,
			]);
		}
		return response()->success( 'STORE', $this, $this->route . '.create' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Commons\Product $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		$this->PageResponse->auxiliar   = [
			'units' => MetricUnit::getAlltoSelectList( [ 'id', 'code' ] ),
		];
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
		];
		return response()->return( $this->main_folder . '.master', $this->PageResponse, $product );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Http\Requests\Commons\ProductManageRequest $request
	 * @param  \App\Models\Commons\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ProductManageRequest $request, Product $product)
	{
		$this->PageResponse->auxiliar   = [
			'units' => MetricUnit::getAlltoSelectList( [ 'id', 'code' ] ),
		];
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>route($this->route . '.index'),'text'=>$this->names],
			['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
		];
		return response()->return( $this->main_folder . '.master', $this->PageResponse, $product );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Commons\ProductRequest $request
	 * @param  \App\Models\Commons\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductRequest $request, Product $product)
	{
		$product->update($request->all());
		$image = $request->file('image');
		if($image != NULL){
			Picture::updateOrCreate([
				'filename'      => $image,
				'active'        => 1,
			],['product_id'    => $product->id]);
		}
		return response()->success('UPDATE', $this, [$this->route.'.edit', $product->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  \App\Models\Commons\Product  $product
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		if(EntrustFacade::hasRole(['buyer','manager'])){
			$product->delete();
			return 1;
		}
		return 0;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function export()
	{
		$products = Product::all();
		return ExportHelper::products($products);
	}
}
