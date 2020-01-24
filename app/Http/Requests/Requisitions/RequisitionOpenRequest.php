<?php

namespace App\Http\Requests\Requisitions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Zizaco\Entrust\EntrustFacade;

//use Zizaco\Entrust\Entrust;

class RequisitionOpenRequest extends FormRequest
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return (EntrustFacade::hasRole(['coordenator','manager','financial']));
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'job_id'            => 'required|exists:jobs,id',
			'group_id'          => 'required|exists:groups,id',
			'subgroup_id'       => 'required|exists:sub_groups,id',
//			'supplier_id'       => 'required|exists:suppliers,id',
			'main_descriptions' => 'required|min:3|max:500'
		];
	}

	/**
	 * Get the response that handle the request errors.
	 *
	 * @param  array $errors
	 * @return array
	 */
	public function response(array $errors)
	{
		return response()->request( $errors );
	}
}

