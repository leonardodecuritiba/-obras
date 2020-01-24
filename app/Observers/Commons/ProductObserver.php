<?php

namespace App\Observers\Commons;

use App\Models\Commons\Picture;
use App\Models\Commons\Product;
use Illuminate\Http\Request;

class ProductObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Product updating event.
	 *
	 * @param  \App\Models\Commons\Product $product
	 *
	 * @return void
	 */
//	public function created( Product $product)
//	{
//		$image = $this->request->file('image');
//		if($image != NULL){
//			Picture::create([
//				'product_id'    => $product->id,
//				'filename'      => $image,
//				'active'        => 1,
//			]);
//		}
////		$this->request->file('image')
//	}
	/**
	 * Listen to the Product updating event.
	 *
	 * @param  \App\Models\Commons\Product $product
	 *
	 * @return void
	 */
//	public function saving( Product $product)
//	{
//		dd(1);
////		$this->request->file('image')
//	}
	/**
	 * Listen to the Group deleting event.
	 *
	 * @param  \App\Models\Commons\Product $product
	 *
	 * @return void
	 */
	public function deleting( Product $product)
	{
		if($product->image != NULL) $product->image->delete();
	}
}