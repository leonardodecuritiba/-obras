<?php

namespace App\Models\Requisitions;

use App\Helpers\DataHelper;
use App\Models\Commons\Brand;
use App\Models\Suppliers\Supplier;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;

class RequisitionBuy extends Model
{
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'requisition_budget_id',
		'supplier_id',
		'brand_id',
		'quantity',
		'value'
	];

	static public function addProduct($data)
	{
		return self::create(
			$data
		);
	}

	public function getBrandName()
	{
		return $this->brand->getShortName();
	}

	public function getSupplierName()
	{
		return $this->supplier->getShortName();
	}

	public function getProductName()
	{
		return $this->requisition_budget->product->getShortName();
	}

	public function getProductShortCodeName()
	{
		return $this->requisition_budget->product->getShortCodeName();
	}

	public function getValueMoney()
	{
		return DataHelper::getFloat2Currency($this->getAttribute('value'));
	}

	public function getTotalValueMoney()
	{
		return DataHelper::getFloat2Currency($this->getTotalValue());
	}

	public function getTotalValue()
	{
		return $this->getAttribute('quantity') * $this->getAttribute('value');
	}

	public function setQuantityAttribute($value)
	{
		$this->attributes['quantity'] = DataHelper::getReal2Float($value);
	}

	public function getQuantityFormatted()
	{
		return DataHelper::getFloat2Real($this->getAttribute('quantity'));
	}

	// ******************** RELASHIONSHIP ******************************

	public function requisition_budget()
	{
		return $this->belongsTo(RequisitionBudget::class, 'requisition_budget_id');
	}

	public function supplier()
	{
		return $this->belongsTo(Supplier::class, 'supplier_id');
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id');
	}

}