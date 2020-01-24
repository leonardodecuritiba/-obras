<?php

namespace App\Http\Requests\Requisitions;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\DataHelper;

class RequisitionAddBudgetProductRequest extends FormRequest
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
//		dd($this->get('quantity'));
//		$regex = "/^\d*(\,\d{2})?$/";
		$regex = "/^\d*(.\d{3})*(\,\d{2})?$/";
		return [
			'product_id'=> 'required|exists:products,id',
//			'brand_id'  => 'sometimes|exists:brands,id',
			'quantity'  => 'required|min:1|regex:'.$regex,
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

