<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class SupplierRequest extends FormRequest
{
	private $table = 'suppliers';

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
		$rules = [
			'cnpj'          => 'required|min:3|max:20|unique:' . $this->table . ',cnpj',
			'ie'            => $this->has('isention_ie') ? '' : 'required|min:3|max:20|unique:' . $this->table . ',ie',
			'fantasy_name'  => 'required|min:3|max:100',
			'company_name'  => 'required|min:3|max:100',
//			'foundation'    => 'sometimes|date_format:"dmY"',
			'favored_name'  => 'max:100',
			'bank'          => 'max:100',
			'agency'        => 'max:10',
			'account'       => 'max:30',
		];

		switch ($this->method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				if($this->get('favored_cnpj')!=''){
					$rules['favored_cnpj']  = 'required|min:3|max:20';//|unique:' . $this->table . ',favored_cnpj';
				} else if($this->get('favored_cnpj')!=''){
					$rules['favored_cpf']   = 'required|min:3|max:20';//|unique:' . $this->table . ',favored_cpf';
				}
				return $rules;
			}
			case 'PUT':
			case 'PATCH': {
				$rules['cnpj']          = 'required|min:3|max:20|unique:' . $this->table . ',cnpj,' . $this->supplier->id . ',id';
				$rules['ie']            = $this->has('isention_ie') ? '' : 'required|min:3|max:20|unique:' . $this->table . ',ie,' . $this->supplier->id . ',id';

				if($this->get('favored_cnpj')!=''){
					$rules['favored_cnpj']  = 'required|min:3|max:20';//|unique:' . $this->table . ',favored_cnpj,' . $this->supplier->id . ',id';
				} else if($this->get('favored_cnpj')!=''){
					$rules['favored_cpf']  = 'required|min:3|max:20';//|unique:' . $this->table . ',favored_cpf,' . $this->supplier->id . ',id';
				}
				return $rules;
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

