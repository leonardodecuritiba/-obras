<?php

namespace App\Http\Controllers\Requisitions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisitions\RequisitionAddBudgetProductRequest;
use App\Http\Requests\Requisitions\RequisitionAddProductRequest;
use App\Http\Requests\Requisitions\RequisitionAddRequest;
use App\Http\Requests\Requisitions\RequisitionAddSupplierRequest;
use App\Http\Requests\Requisitions\RequisitionApproveRequest;
use App\Http\Requests\Requisitions\RequisitionBuyRequest;
use App\Http\Requests\Requisitions\RequisitionCloseCotationRequest;
use App\Http\Requests\Requisitions\RequisitionCloseRequest;
use App\Http\Requests\Requisitions\RequisitionOpenRequest;
use App\Http\Requests\Requisitions\RequisitionReopenRequest;
use App\Models\Clients\Client;
use App\Models\Commons\Brand;
use App\Models\Commons\Group;
use App\Models\Commons\Plight;
use App\Models\Commons\Product;
use App\Models\Requisitions\Requisition;
use App\Models\Requisitions\RequisitionBudget;
use App\Models\Requisitions\RequisitionBuy;
use App\Models\Requisitions\RequisitionProduct;
use App\Models\Requisitions\RequisitionSupplier;
use App\Models\Suppliers\Supplier;
use App\Models\Users\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
	public $entity = "requisitions";
	public $sex = "F";
	public $name = "Requisição";
	public $names = "Requisições";
	public $route = "requisitions";
	public $main_folder = 'pages.requisitions';
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
	    $this->PageResponse->response   = Requisition::with('job','author.user','group','subgroup','plight')->get();
	    return view( $this->main_folder . '.index' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Show the form for open a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
	    $this->PageResponse->main_title = trans('pages.view.OPEN', [ 'name' => $this->name ]);
	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route($this->route . '.index'),'text'=>$this->names],
		    ['route'=>NULL,'text'=> trans('pages.view.OPEN', [ 'name' => $this->name ])],
	    ];
	    $this->PageResponse->auxiliar   = [
		    'clients'       => Client::getAlltoSelectList(),
		    'collaborators' => Collaborator::getAlltoSelectList( [ 'id', 'name' ] ),
		    'groups'        => Group::getAlltoSelectList( [ 'id', 'name' ] )
	    ];
//	    $this->PageResponse->response   = Requisition::with('job','author.user','group','subgroup','plight')->get();
//	    return $this->PageResponse->response;
	    return view( $this->main_folder . '.open' )
		    ->with( 'PageResponse', $this->PageResponse );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
	    $this->PageResponse->auxiliar   = [
		    'suppliers' => Supplier::getAlltoSelectList(['id','name'],false),
		    'products'  => Product::getAlltoSelectList(['id','name'],false),
		    'plights'   => Plight::getAlltoSelectList( [ 'id', 'name' ] ),
		    'brands'    => Brand::getAlltoSelectList(['id','name']),
		    'doc_types' => Requisition::$_DOC_TYPE_,
		    'parcelas'  => Requisition::$_PARCELAS_,
	    ];
	    $this->PageResponse->auxiliar['requisition_route'] = $this->PageResponse->route . '.' . $requisition->getActionRoute();
	    $this->PageResponse->auxiliar['requisition_breadcrumb'] = $requisition->getBreadcrumb();

	    $this->PageResponse->breadcrumb = [
		    ['route'=>route('index'),'text'=>'Home'],
		    ['route'=>route($this->route . '.index'),'text'=>$this->names],
		    ['route'=>NULL,'text'=> trans('pages.view.SHOW', [ 'name' => $this->name ])],
	    ];
	    return view( $this->main_folder . '.show' )
		    ->with( 'PageResponse', $this->PageResponse )
		    ->with( 'Data', $requisition );
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Requisitions\RequisitionOpenRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function open(RequisitionOpenRequest $request)
	{
		$request->merge(['author_id' => Auth::user()->collaborator->id]);
		$requisition = Requisition::open($request->all());
		return response()->success('UPDATE', $this, [$this->route.'.show', $requisition->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Http\Requests\Requisitions\RequisitionCloseRequest $request
	 * @param  \App\Models\Requisitions\Requisition $requisition
	 * @return \Illuminate\Http\Response
	 */
	public function close(RequisitionCloseRequest $request, Requisition $requisition)
	{
		$requisition->close();
		return response()->success('UPDATE', $this, $this->route.'.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Http\Requests\Requisitions\RequisitionReopenRequest $request
	 * @param  \App\Models\Requisitions\Requisition $requisition
	 * @return \Illuminate\Http\Response
	 */
	public function reopen(RequisitionReopenRequest $request, Requisition $requisition)
	{
		$requisition->reopen($request->all());
		return response()->success('UPDATE', $this, [$this->route.'.show', $requisition->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Http\Requests\Requisitions\RequisitionAddProductRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function addProduct(RequisitionAddProductRequest $request)
	{
		$requisition_buy = RequisitionBuy::addProduct($request->all());
		return response()->success('UPDATE', $this, [$this->route.'.show', $requisition_buy->requisition_budget->requisition_id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Requisitions\RequisitionBuy $requisition_buy
	 * @return \Illuminate\Http\Response
	 */
	public function remProduct(RequisitionBuy $requisition_buy)
	{
		$id = $requisition_buy->requisition_budget->requisition_id;
		$requisition_buy->delete();
		return response()->success('UPDATE', $this, [$this->route.'.show', $id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Http\Requests\Requisitions\RequisitionAddBudgetProductRequest $request
	 * @param  \App\Models\Requisitions\Requisition $requisition
	 * @return \Illuminate\Http\Response
	 */
	public function addBudgetProduct(RequisitionAddBudgetProductRequest $request, Requisition $requisition)
	{
		$requisition->addBudgetProduct($request->all());
		return response()->success('UPDATE', $this, [$this->route.'.show', $requisition->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Requisitions\RequisitionBudget $requisition_budget
	 * @return \Illuminate\Http\Response
	 */
	public function remBudgetProduct(RequisitionBudget $requisition_budget)
	{
		$id = $requisition_budget->requisition_id;
		$requisition_budget->delete();
		return response()->success('UPDATE', $this, [$this->route.'.show', $id]);
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Requisitions\RequisitionCloseCotationRequest $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function closeCotation(RequisitionCloseCotationRequest $request, Requisition $requisition)
    {
	    $requisition->closeCotation($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Requisition $requisition)
    {
	    $request->merge(['approver_id' => Auth::user()->collaborator->id]);
	    $requisition->approve($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function unapprove(Request $request, Requisition $requisition)
    {
	    $requisition->unapprove($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function recotation(Request $request, Requisition $requisition)
    {
	    $requisition->recotation();
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Http\Requests\Requisitions\RequisitionBuyRequest $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function buy(RequisitionBuyRequest $request, Requisition $requisition)
    {
	    $request->merge(['buyer_id' => Auth::user()->collaborator->id]);
	    $requisition->buy($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function delivery(Request $request, Requisition $requisition)
    {
	    $requisition->delivery($request->all());
	    return response()->success('UPDATE', $this, $this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisitions\Requisition $requisition
     * @return \Illuminate\Http\Response
     */
    public function remove(Requisition $requisition)
    {
        $requisition->delete();
        return response()->success('DELETE', $this, $this->route.'.index');
    }
}
