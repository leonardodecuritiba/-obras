<?php

namespace App\Models\Requisitions;

use App\Helpers\DataHelper;
use App\Models\Commons\Brand;
use App\Models\Commons\Product;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;

class RequisitionBudget extends Model
{
	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'requisition_id',
		'product_id',
		'brand_id',
		'quantity',
	];

	public function getDataJson()
	{
		return json_encode([
			'id'            => $this->id,
			'code_name'     => $this->getProductShortCodeName(),
			'brand_name'    => $this->getBrandName(),
			'quantity'      => $this->getQuantityFormatted(),
			'unit'          => $this->getUnitShortName(),
		]);
	}

	public function getUnitName()
	{
		return ($this->getAttribute('product_id') != NULL) ? $this->product->getUnitName() : '-';
	}

	public function getBrandName()
	{
		return ($this->getAttribute('brand_id') != NULL) ? $this->brand->getShortName() : '-';
	}

	public function getProductName()
	{
		return $this->product->getShortName();
	}

	public function getProductShortCodeName()
	{
		return $this->product->getShortCodeName();
	}

	public function getUnitShortName()
	{
		return $this->product->getUnitName();
	}

	public function getTotal()
	{
		return ($this->requisition_buy != NULL) ? $this->requisition_buy->getTotalValue() : 0;
	}

	public function setQuantityAttribute($value)
	{
		$this->attributes['quantity'] = DataHelper::getReal2Float($value);
	}

	public function getQuantityFormatted()
	{
		return DataHelper::getFloat2Real($this->getAttribute('quantity'));
	}

	public function getQuantityUnitFormatted()
	{
		return $this->getQuantityFormatted() . " (" . $this->getUnitName(). ")";
	}

	// ******************** RELASHIONSHIP ******************************

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id');
	}
	public function requisition()
	{
		return $this->belongsTo(Requisition::class, 'requisition_id');
	}
	public function requisition_buy()
	{
		return $this->hasOne(RequisitionBuy::class, 'requisition_budget_id');
	}
}