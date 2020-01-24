<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\MetricUnitRequest;
use App\Models\Commons\MetricUnit;
use Illuminate\Routing\Route;

class MetricUnitController extends Controller
{
	public $entity = "metric_units";
	public $sex = "F";
	public $name = "Unidade de Medida";
	public $names = "Unidades de Medidas";
	public $route = "metric_units";
	public $main_folder = 'pages.metric_units';
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
	    $this->PageResponse->response   = MetricUnit::all();
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
     * @param  \App\Http\Requests\Commons\MetricUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetricUnitRequest $request)
    {
	    MetricUnit::create($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commons\MetricUnit  $metricUnit
     * @return \Illuminate\Http\Response
     */
    public function show(MetricUnit $metricUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commons\MetricUnit  $metricUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(MetricUnit $metricUnit)
    {
	    return view( $this->main_folder . '.master' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $metricUnit );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Commons\MetricUnitRequest  $request
     * @param  \App\Models\Commons\MetricUnit  $metricUnit
     * @return \Illuminate\Http\Response
     */
    public function update(MetricUnitRequest $request, MetricUnit $metricUnit)
    {
	    $metricUnit->update($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index', $metricUnit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commons\MetricUnit  $metricUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetricUnit $metricUnit)
    {
	    $metricUnit->delete();
    	return 1;
    }
}
