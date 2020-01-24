<?php

namespace App\Http\Requests\Commons;

use Illuminate\Foundation\Http\FormRequest;
use Zizaco\Entrust\EntrustFacade;

class ProductManageRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return (EntrustFacade::hasRole(['buyer','manager']));
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [];
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

