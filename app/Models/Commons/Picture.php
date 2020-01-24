<?php

namespace App\Models\Commons;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class Picture extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['product_id','filename', 'active'];

	const _DEFAULT_SIZE_ = [1000,1000];
	const _DEFAULT_SIZE_THUMB_ = [100,100];
	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
	static public function getPath(){
		return 'uploads' . DIRECTORY_SEPARATOR . 'products'
		//		              . DIRECTORY_SEPARATOR . $this->getAttribute('product_id')
		. DIRECTORY_SEPARATOR;
	}
	static public function getPathThumb(){
		return 'uploads' . DIRECTORY_SEPARATOR . 'products_thumb'
		//		              . DIRECTORY_SEPARATOR . $this->getAttribute('product_id')
		. DIRECTORY_SEPARATOR ;
	}

	public function getPathImage()
	{
		return self::getPath() . $this->getAttribute('filename');
	}

	public function getPathThumbImage()
	{
		return self::getPathThumb() . $this->getAttribute('filename');
	}


	public function getPrintImage($thumb = false)
	{
		return public_path( ( $thumb ? $this->getPathThumbImage() : $this->getPathImage() ) );
	}


	public function getImage($thumb = false)
	{
		return asset(($thumb ? $this->getPathThumbImage() : $this->getPathImage()));

		/*

		$size = ($size == NULL) ? [75,75] : $size;
		return 'http://placehold.it/' . $size[0] . 'x' . $size[1];

		$type = 'png';
		$image_path = 'uploads' . DIRECTORY_SEPARATOR . 'products'
		              //		              . DIRECTORY_SEPARATOR . $this->getAttribute('product_id')
		              . DIRECTORY_SEPARATOR . $this->getAttribute('filename');
//		if (!File::exists(public_path($image_path))) {
//			$this->delete();
//			$size = ($size == NULL) ? [50,50] : $size;
//			return 'http://placehold.it/' . $size[0] . 'x' . $size[1];
//		} else

//		dd(public_path($image_path));
		if($resize) {
			$size = ($size == NULL) ? [75,75] : $size;
			$img = Image::make(public_path($image_path))->resize($size[0], $size[1], function ($constraint) {
				$constraint->aspectRatio();
			})->encode($type, 75);
			return 'data:image/' . $type . ';base64,' . base64_encode($img);
		}
		return asset($image_path);
		*/
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/
	public function getFilenameAttribute()
	{
		$attribute_name = 'filename';
		return $this->attributes[$attribute_name];
		/*
		// OLD PATH
		$value = $this->getFilenameFromOldPath();
		if (!empty($value)) {
			return $value;
		}

		// NEW PATH
		if (!isset($this->attributes) || !isset($this->attributes['filename'])) {
			return null;
		}

		$value = $this->attributes['filename'];

		if (Storage::exists($value)) {
			if (Request::segment(1) == config('larapen.admin.route_prefix', 'admin')) {
				$value = 'uploads/' . $value;
			}
		} else {
			dd('erro');
			$value = config('larapen.core.picture');
		}

		return $value;
		*/
	}

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
	public function setFilenameAttribute($value)
	{
		// If laravel request->file('filename') resource OR base64 was sent, store it in the db
		try {
			// Make the image
//			$filename  = time() . '.' . $value->getClientOriginalExtension();
//			$path = public_path('profilepics/' . $filename);
//			$image = Image::make($value->getRealPath())->resize(1000, 1000, function ($constraint) {
//				$constraint->aspectRatio();
//			});
			// ---------------- PATH ----------------------------

			$filename = md5(time()) .'.'. $value->getClientOriginalExtension();
			$this->attributes['filename'] = $filename;
			$path = public_path(self::getPath());

			File::makeDirectory($path, $mode = 0777, true, true);

			Image::make($value->getRealPath())->resize(self::_DEFAULT_SIZE_[0], self::_DEFAULT_SIZE_[1], function ($constraint) {
				$constraint->aspectRatio();
			})->save($path . DIRECTORY_SEPARATOR . $filename);

			// ---------------- THUMB PATH ----------------------

			$path = public_path(self::getPathThumb());

			File::makeDirectory($path, $mode = 0777, true, true);

			Image::make($value->getRealPath())->resize(self::_DEFAULT_SIZE_THUMB_[0], self::_DEFAULT_SIZE_THUMB_[1], function ($constraint) {
				$constraint->aspectRatio();
			})->save($path . DIRECTORY_SEPARATOR . $filename);


		} catch (\Exception $e) {
			dd($e->getMessage());
			$this->attributes['filename'] = null;
			return false;
		}


//		// Generate a filename.
//		$filename = md5($value . time()) . '.jpg';
//
//		// Store the image on disk.
//		Storage::put($path . '/' . $filename, $image->stream());
//
//		// Save the path to the database
//		$this->attributes[$attribute_name] = $destination_path . '/' . $filename;
	}
}
