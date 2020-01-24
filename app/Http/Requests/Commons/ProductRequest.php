<?php

namespace App\Http\Requests\Commons;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
	private $table = 'products';
	private $id;

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
		switch ($this->method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'name'          => 'required|min:3|max:100|unique:' . $this->table . ',name',
					'unit_id'       => 'required|exists:metric_units,id',
					'code'          => 'sometimes|min:1|max:20',
					'description'   => 'sometimes|min:3|max:500',
					'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'name'          => 'required|min:3|max:100|unique:' . $this->table . ',name,' . $this->product->id . ',id',
					'unit_id'       => 'required|exists:metric_units,id',
					'code'          => 'sometimes|min:1|max:20',
					'description'   => 'sometimes|min:3|max:500',
					'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				];
			}
			default:
				break;
		}
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

