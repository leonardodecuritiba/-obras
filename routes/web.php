<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
	return view('welcome');
})->name('index')->middleware('auth');


Route::group( [ 'prefix' => 'ajax', 'middleware' => 'auth' ], function () {
	Route::get( 'state-city', 'Commons\AjaxController@getStateCityToSelect' )->name('ajax.get.state-city');
	Route::get( 'client-units', 'Commons\AjaxController@getClientUnitsToSelect' )->name('ajax.get.client-units');
	Route::get( 'unit-jobs', 'Commons\AjaxController@getUnitJobsToSelect' )->name('ajax.get.unit-jobs');
	Route::get( 'client-jobs', 'Commons\AjaxController@getClientJobsToSelect' )->name('ajax.get.client-jobs');
	Route::get( 'groups-subgroups', 'Commons\AjaxController@getGroupsSubgroupsToSelect' )->name('ajax.get.groups-subgroups');
});
Route::group( [ 'prefix' => 'main_configs', 'middleware' => 'auth' ], function () {
	/*
	|--------------------------------------------------------------------------
	| Metric Units Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'metric_units', 'Commons\MetricUnitController' );

	/*
	|--------------------------------------------------------------------------
	| Groups Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'groups', 'Commons\GroupController' );

	/*
	|--------------------------------------------------------------------------
	| SubGroups Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'sub_groups', 'Commons\SubGroupController' );
	Route::get('sub_groups/create/{group_id}', 'Commons\SubGroupController@create' )->name('sub_groups.create');
	/*
	|--------------------------------------------------------------------------
	| Groups Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'plights', 'Commons\PlightController' );
	/*
	|--------------------------------------------------------------------------
	| Products Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'products', 'Commons\ProductController' );
	Route::get('products-export', 'Commons\ProductController@export' )->name('products.export');

	/*
	|--------------------------------------------------------------------------
	| Brands Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'brands', 'Commons\BrandController' );
} );

Route::group( [ 'prefix' => 'main_clients' , 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Client Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'clients', 'Clients\ClientController' );
	/*
	|--------------------------------------------------------------------------
	| Units Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'units', 'Clients\UnitController' );
	Route::get('units/create/{client_id}', 'Clients\UnitController@create' )->name('units.create');


	/*
	|--------------------------------------------------------------------------
	| Jobs Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'jobs', 'Clients\JobController' );
	Route::get('jobs/create/{client_id}', 'Clients\JobController@create' )->name('jobs.create');

} );
Route::group( [ 'prefix' => 'main_suppliers', 'middleware' => 'auth' ], function () {
	/*
	|--------------------------------------------------------------------------
	| Suppliers Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'suppliers', 'Suppliers\SupplierController' );
} );
Route::group( [ 'prefix' => 'main_reports', 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Requisitions Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::get('requisitions', 'Activities\ReportController@requisitions' )->name('requisitions.report');
	Route::get('requisitions-export', 'Activities\ReportController@requisitionsExport' )->name('requisitions.export');
	Route::get('requisitions-print', 'Activities\ReportController@requisitionsPrint' )->name('requisitions.print');

	Route::get('requisitions-budget-print/{requisition}', 'Activities\ReportController@requisitionBudgetPrint' )->name('requisitions_budget.print');
	Route::get('requisitions-budget-export/{requisition}', 'Activities\ReportController@requisitionBudgetExport' )->name('requisitions_budget.export');
	Route::get('requisitions-buyed-print/{requisition}', 'Activities\ReportController@requisitionBuyedPrint' )->name('requisitions_buyed.print');
	Route::get('requisitions-buyed-export/{requisition}', 'Activities\ReportController@requisitionBuyedExport' )->name('requisitions_buyed.export');
	/*
	|--------------------------------------------------------------------------
	| Products Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::get('products', 'Activities\ReportController@products' )->name('products.report');
	Route::get('products-export', 'Activities\ReportController@productsExport' )->name('products.export');
	Route::get('products-print', 'Activities\ReportController@productsPrint' )->name('products.print');
	Route::get('products-print-all', 'Activities\ReportController@productsPrintAll' )->name('products.print-all');
} );
Route::group( [ 'prefix' => 'main_activities', 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Requisitions Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'requisitions', 'Requisitions\RequisitionController' )->except(['create','edit','destroy']);
	Route::get( 'requisitions-remove/{requisition}', 'Requisitions\RequisitionController@remove' )->name('requisitions.remove');

	Route::group(['middleware' => ['role:coordenator|manager|financial']], function() {
		Route::get( 'request', 'Requisitions\RequisitionController@request' )->name('requisitions.request');
	});

	Route::post( 'open', 'Requisitions\RequisitionController@open' )->name('requisitions.open');

//	Route::post( 'add-supplier/{requisition}', 'Requisitions\RequisitionController@addSupplier' )->name('requisitions.addSupplier');
	Route::post( 'add-product', 'Requisitions\RequisitionController@addProduct' )->name('requisitions.add');
	Route::get( 'rem-product/{requisition_buy}', 'Requisitions\RequisitionController@remProduct' )->name('requisitions.rem');

	Route::post( 'close/{requisition}', 'Requisitions\RequisitionController@close' )->name('requisitions.close');
	Route::post( 'reopen/{requisition}', 'Requisitions\RequisitionController@reopen' )->name('requisitions.reopen');
	Route::post( 'close-cotation/{requisition}', 'Requisitions\RequisitionController@closeCotation' )->name('requisitions.close_cotation');
	Route::post( 'approve/{requisition}', 'Requisitions\RequisitionController@approve' )->name('requisitions.approve');
	Route::post( 'unapprove/{requisition}', 'Requisitions\RequisitionController@unapprove' )->name('requisitions.unapprove');
	Route::post( 'recotation/{requisition}', 'Requisitions\RequisitionController@recotation' )->name('requisitions.recotation');
	Route::post( 'buy/{requisition}', 'Requisitions\RequisitionController@buy' )->name('requisitions.buy');
	Route::post( 'delivery/{requisition}', 'Requisitions\RequisitionController@delivery' )->name('requisitions.delivery');

	//budget
	Route::post( 'add-product-budget/{requisition}', 'Requisitions\RequisitionController@addBudgetProduct' )->name('requisitions.budget_add');
	Route::post( 'rem-product-budget/{requisition_budget}', 'Requisitions\RequisitionController@remBudgetProduct' )->name('requisitions.budget_rem');

} );
Route::group( [ 'prefix' => 'main_users', 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Collaborators Routes
	|--------------------------------------------------------------------------
	|
	*/
	Route::resource( 'collaborators', 'Users\CollaboratorController' );
	Route::get( 'my-profile', 'Users\CollaboratorController@getMyProfile' )->name('collaborators.profile');
} );
Route::group( [ 'prefix' => 'testing'], function () {
	Route::get('sendemail', function () {
		$user = array(
			'email' => "silva.zanin@gmail.com",
			'name' => "Leonardo",
			'mensagem' => "TESTE OK",
		);

		Mail::raw($user['mensagem'], function ($message) use ($user) {
			$message->to($user['email'], $user['name'])->subject('Welcome!');
			$message->from(config('mail.from.address'), config('mail.from.name'));
		});

		return "Your email has been sent successfully";

	});


	//http://localhost:8000/teste/rename-imgs
	Route::get('rename-imgs', function () {

		set_time_limit(60 * 60 * 5);
		$thumb_path = public_path(\App\Models\Commons\Picture::getPathThumb());
		File::makeDirectory($thumb_path, $mode = 0777, true, true);
		$images = \App\Models\Commons\Picture::all();

		foreach ($images as $image){
			$filename = public_path($image->getPathImage());
			if($image->product == NULL){
				//remover imagem sem produto
//				echo $image->id . ' (' . $filename . '): REMOVIDA POIS NÃO EXISTE<br>';
				echo $image->id . ': REMOVIDA<br>';
				$image->delete();
			} else {
				echo $image->id .': ADICIONADA AO THUMB **<br>';
				Intervention\Image\Facades\Image::make($filename)->resize(\App\Models\Commons\Picture::_DEFAULT_SIZE_THUMB_[0],\App\Models\Commons\Picture::_DEFAULT_SIZE_THUMB_[1], function ($constraint) {
					$constraint->aspectRatio();
				})->save($thumb_path . $image->filename);
			}



			//CRIAR IMAGENS EXTRAS

//			return $filename;



//			Image::make($value->getRealPath())->resize(1000, 1000, function ($constraint) {
//				$constraint->aspectRatio();
//			})->save($thumb_path . DIRECTORY_SEPARATOR . $filename);




//
//
//
//
//			$type = 'png';
//			$image_path = 'uploads' . DIRECTORY_SEPARATOR . 'products'
//			              //		              . DIRECTORY_SEPARATOR . $this->getAttribute('product_id')
//			              . DIRECTORY_SEPARATOR . $this->getAttribute('filename');
//
//
//			dd($image_path);
//			if($resize) {
//				$size = ($size == NULL) ? [75,75] : $size;
//				$img = Image::make(public_path($image_path))->resize($size[0], $size[1], function ($constraint) {
//					$constraint->aspectRatio();
//				})->encode($type, 75);
//				return 'data:image/' . $type . ';base64,' . base64_encode($img);
//			}
//			return asset($image_path);
		}
	});
} );
