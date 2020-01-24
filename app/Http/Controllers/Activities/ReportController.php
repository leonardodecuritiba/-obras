<?php

namespace App\Http\Controllers\Activities;

use App\Helpers\DataHelper;
use App\Helpers\ExportHelper;
use App\Helpers\PrintHelper;
use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use App\Models\Clients\Job;
use App\Models\Clients\Unit;
use App\Models\Commons\Group;
use App\Models\Commons\Plight;
use App\Models\Commons\Product;
use App\Models\Requisitions\Requisition;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ReportController extends Controller
{
	public $entity = "requisitions";
	public $sex = "F";
	public $name = "Requisição";
	public $names = "Requisições";
	public $route = "requisitions";
	public $main_folder = 'pages.reports';
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


	public function filter(Request $request, $option, $pagination = false)
	{
		set_time_limit(60 * 60 * 5);
		if(!$request->has('print-all') && !$request->has('search')){return [];}
		if($option == 'requisitions'){

			$requisition = (new Requisition)->newQuery();

			// Search for a user based on their name.
			if ($request->has('client_id') && ($request->get('client_id') != '')) {
				$unit_id = Unit::where('client_id',$request->get('client_id'))->pluck('id');
				$job_id = Job::whereIn('unit_id',$unit_id)->pluck('id');
				$requisition->whereIn('job_id', $job_id);
			}

			if ($request->has('job_id') && ($request->get('job_id') != '')) {
				$requisition->where( 'job_id', $request->input( 'job_id' ) );
			}

			$fields = ['group_id','subgroup_id','plight_id'];

			foreach($fields as $field)
			{
				if ($request->has($field) && ($request->get($field) != '')) {
					$requisition->where( $field, $request->get( $field ) );
				}
			}
			$filter = $requisition;
		} else {

			$product = (new Product)->newQuery();
			$fields = ['code','name','description'];

			foreach($fields as $field)
			{
				if ($request->has($field) && ($request->get($field) != '')) {
					$product->where( $field,'like', '%' .  $request->input( $field ).'%' );
				}
			}
			$filter = $product->orderBy('code');
		}
		return ($pagination) ? $filter->paginate(10) : $filter->get();
	}


	public function filterMap(Request $request, $option, $pagination = false)
	{
		$filter = $this->filter($request, $option, $pagination);

		if(($option == 'requisitions') && ($filter != NULL)){
			if($pagination){
				return [
					'filter'=>$filter,
					'items' =>$filter->getCollection()->transform(function($s){
						$s->group_name      = $s->group->name;
						$s->subgroup_name   = $s->subgroup->name;
						$s->plight_name     = $s->getShortPlightName();
						$s->total           = $s->getTotal();
						$s->total_formatted = $s->getTotalMoney();

						$buy_at = $s->setBuyAtFormatted();
						$s->buy_at_formatted = ($buy_at == NULL) ? '-' : $buy_at;
						$s->document_number = ($s->document_number == NULL) ? '-' : $s->document_number;
						return $s;
					})
				];
			}
			return $filter->map(function($s){
				$s->group_name      = $s->group->name;
				$s->subgroup_name   = $s->subgroup->name;
				$s->plight_name     = $s->getShortPlightName();
				$s->total           = $s->getTotal();
				$s->total_formatted = $s->getTotalMoney();

				$buy_at = $s->setBuyAtFormatted();
				$s->buy_at_formatted = ($buy_at == NULL) ? '-' : $buy_at;
				$s->document_number = ($s->document_number == NULL) ? '-' : $s->document_number;
				return $s;
			});
		} else {
			return $filter;
		}
	}
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function requisitions(Request $request)
    {
	    $this->PageResponse->auxiliar   = [
		    'clients'       => Client::getAlltoSelectList(),
		    'groups'        => Group::getAlltoSelectList( [ 'id', 'name' ] ),
		    'plights'       => Plight::getAlltoSelectList( [ 'id', 'name' ] )
	    ];


	    if($request->has('client_id') && ($request->get('client_id')!='')){
		    $client = Client::findOrFail($request->get('client_id'));
		    $this->PageResponse->auxiliar['jobs'] = Job::whereIn('unit_id',$client->units->pluck('id'))->get()->map(function($p){
			    $p->id = $p->id;
			    $p->text = $p->unit->name . ' / ' . $p->name;
			    return $p;
		    })->pluck('text','id');
	    }
	    $this->PageResponse->paginate = NULL;
	    $this->PageResponse->response = $this->filterMap($request,'requisitions', true);
	    $total = 0;
	    if($this->PageResponse->response != NULL){
		    $this->PageResponse->paginate = $this->PageResponse->response['filter'];
		    $this->PageResponse->response = $this->PageResponse->response['items'];

		    if($this->PageResponse->paginate->total()>0){
			    $total = $this->PageResponse->response->sum('total');
		    }
	    }
	    $this->PageResponse->auxiliar['sum_requisitions'] = $total;
	    $this->PageResponse->auxiliar['sum_requisitions_real'] = DataHelper::getFloat2Currency($total);
//	    if($this->PageResponse->response)
	    $this->PageResponse->main_title = trans('pages.view.REPORT', [ 'name' => 'Requisições' ]);
	    $this->PageResponse->page_noresults = trans('pages.view.NORESULTS.'.$this->sex, [ 'name' => $this->name ]);
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>NULL,'text'=> 'Requisições']
	    ];
	    return view( $this->main_folder . '.requisitions' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Export a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionsExport(Request $request)
    {
	    $request->merge(['search'=>1]);
	    return ExportHelper::requisitions($this->filterMap($request,'requisitions'));
    }

    /**
     * Print a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionsPrint(Request $request)
    {
	    $request->merge(['search'=>1]);
	    return PrintHelper::requisitions($this->filterMap($request,'requisitions'));
    }

    /**
     * Print a listing of the resource.
     *
     * @param \App\Models\Requisitions\Requisition $requisition
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionBudgetPrint(Requisition $requisition)
    {
	    return PrintHelper::requisitionPrint($requisition,'budget');
    }


    /**
     * Print a listing of the resource.
     *
     * @param \App\Models\Requisitions\Requisition $requisition
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionBudgetExport(Requisition $requisition)
    {
	    return PrintHelper::requisitionExport( $requisition, 'budget');
    }

    /**
     * Print a listing of the resource.
     *
     * @param \App\Models\Requisitions\Requisition $requisition
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionBuyedPrint(Requisition $requisition)
    {
	    return PrintHelper::requisitionPrint($requisition, 'buyed');
    }


    /**
     * Print a listing of the resource.
     *
     * @param \App\Models\Requisitions\Requisition $requisition
     * @return \App\Helpers\PrintHelper
     */
    public function requisitionBuyedExport(Requisition $requisition)
    {
	    return PrintHelper::requisitionExport($requisition,'buyed');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function products(Request $request)
	{
		$this->PageResponse->route = 'products';
		$this->PageResponse->main_folder = 'pages.products';
		$this->PageResponse->response   = $this->filterMap($request,'products',true);
		$this->PageResponse->main_title = trans('pages.view.REPORT', [ 'name' => 'Produtos' ]);
		$this->PageResponse->page_noresults = trans('pages.view.NORESULTS.'.$this->sex, [ 'name' => $this->name ]);
		$this->PageResponse->breadcrumb = [
			['route'=>route('index'),'text'=>'Home'],
			['route'=>NULL,'text'=> 'Produtos']
		];
		return view( $this->main_folder . '.products' )
			->with( 'PageResponse', $this->PageResponse );
	}

	/**
	 * Export a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \App\Helpers\ExportHelper
	 */
	public function productsExport(Request $request)
	{
		$request->merge(['search'=>1]);
		return ExportHelper::products($this->filterMap($request,'products'));
	}

	/**
	 * Print a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \App\Helpers\ExportHelper
	 */
	public function productsPrint(Request $request)
	{
		$request->merge(['search'=>1]);
		return PrintHelper::products($this->filterMap($request,'products'));
	}

	/**
	 * Print a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \App\Helpers\ExportHelper
	 */
	public function productsPrintAll(Request $request)
	{
		$request->merge(['print-all'=>1]);
//		return $this->filter($request,'products');
		return PrintHelper::products($this->filterMap($request,'products'), true);
	}
}
