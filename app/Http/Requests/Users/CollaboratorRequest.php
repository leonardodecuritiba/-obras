<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class CollaboratorRequest extends FormRequest
{
	private $table = 'collaborators';

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
//		USER 'email', 'password',
		switch ($this->method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'role_id'   => 'required|exists:roles,id',
					'name'      => 'required|string|max:255',
					'email'     => 'required|string|email|max:255|unique:users',
					'password'  => 'required|string|min:6',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
//					'role_id'   => 'required|exists:roles,id',
					'name'      => 'required|string|max:255',
					'email'     => 'required|string|email|max:255|unique:users,email,'. $this->collaborator->user->id . ',id',
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
		return Redirect::back()->withErrors($errors)->withInput();
	}
}

