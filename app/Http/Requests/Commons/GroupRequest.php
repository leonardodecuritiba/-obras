<?php

namespace App\Http\Requests\Commons;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
	private $table = 'groups';
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
					'name'      => 'required|min:3|max:100|unique:' . $this->table . ',name',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'name'      => 'required|min:3|max:100|unique:' . $this->table . ',name,' . $this->group->id . ',id'
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

