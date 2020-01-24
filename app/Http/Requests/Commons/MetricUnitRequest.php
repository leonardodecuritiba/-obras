<?php

namespace App\Http\Requests\Commons;

use Illuminate\Foundation\Http\FormRequest;

class MetricUnitRequest extends FormRequest
{
	private $table = 'metric_units';
	private $get_key = 'metric_unit';
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
					'code'          => 'required|min:1|max:10|unique:' . $this->table . ',code',
					'description'   => 'required|min:3|max:20',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'code'          => 'required|min:1|max:10|unique:' . $this->table . ',code,' . $this->metric_unit->id . ',id',
					'description'   => 'required|min:3|max:20'
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

