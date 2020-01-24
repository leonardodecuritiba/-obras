<?php

namespace App\Http\Requests\Requisitions;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionBuyRequest extends FormRequest
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'address'      => 'required|min:3|max:100',
			'contact'      => 'required|min:3|max:100',
			'phone'        => 'required|min:3|max:20',
			'observations' => 'required|min:3|max:200'
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

