<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function __construct() {
		set_time_limit(3600);
	}
//	static public $collaborator_id;

	/**
	 * Define breadcrumb.
	 * @param  \Illuminate\Routing\Route  $route
	 *
	 */
	public function breadcrumb($route)
	{
		$action = $route->getActionMethod();
		$this->PageResponse->main_title = trans('pages.view.'.strtoupper($action), [ 'name' => $this->name ]);
		$this->PageResponse->page_noresults = trans('pages.view.NORESULTS.'.$this->sex, [ 'name' => $this->name ]);
		switch($action){
//			case 'index':
//				$this->PageResponse->breadcrumb = [
//					['route'=>route('index'),'text'=>'Home'],
//					['route'=>NULL,'text'=> $this->names]
//				];
//				break;
			case 'create':
				$this->PageResponse->breadcrumb = [
					['route'=>route('index'),'text'=>'Home'],
					['route'=>route($this->route . '.index'),'text'=>$this->names],
					['route'=>NULL,'text'=> trans('pages.view.CREATE', [ 'name' => $this->name ])],
				];
				break;
			case 'edit':
				$this->PageResponse->breadcrumb = [
					['route'=>route('index'),'text'=>'Home'],
					['route'=>route($this->route . '.index'),'text'=>$this->names],
					['route'=>NULL,'text'=> trans('pages.view.EDIT', [ 'name' => $this->name ])],
				];
				break;
			default:
				$this->PageResponse->breadcrumb = [
					['route'=>route('index'),'text'=>'Home'],
					['route'=>NULL,'text'=> $this->names]
				];
				break;
		}
	}
}
