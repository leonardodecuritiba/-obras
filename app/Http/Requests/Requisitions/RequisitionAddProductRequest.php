<?php

namespace App\Http\Requests\Requisitions;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\DataHelper;

class RequisitionAddProductRequest extends FormRequest
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
//		$regex = "/^\d*(\,\d{2})?$/";
        $regex = "/^\d*(.\d{3})*(\,\d{2})?$/";
		return [
			'requisition_budget_id' => 'required|exists:requisition_budgets,id',
			'supplier_id'           => 'required|exists:suppliers,id',
			'brand_id'              => 'required|exists:brands,id',
			'value'                 => 'numeric',
			'quantity'              => 'required|min:1|regex:'.$regex,
		];
	}

	protected function getValidatorInstance()
	{
		$data = $this->all();
		$data['value'] = DataHelper::getReal2Float($this->get('value'));
		$this->getInputSource()->replace($data);

		/*modify data before send to validator*/

		return parent::getValidatorInstance();
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

