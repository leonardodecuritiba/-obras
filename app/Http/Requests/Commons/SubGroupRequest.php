<?php

namespace App\Http\Requests\Commons;

use Illuminate\Foundation\Http\FormRequest;

class SubGroupRequest extends FormRequest
{
	private $table = 'sub_groups';
	private $get_key = 'sub_group';
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
					'group_id'  => 'required|exists:groups,id',
					'name'      => 'required|min:3|max:100',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'group_id'  => 'required|exists:groups,id',
					'name'      => 'required|min:3|max:100'
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

