<?php

namespace App\Observers\Commons;

use App\Models\Commons\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureObserver {
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Listen to the Picture deleting event.
	 *
	 * @param  \App\Models\Commons\Picture $picture
	 *
	 * @return void
	 */
	public function deleting( Picture $picture)
	{
		if (!empty($picture->filename)) {
			$filename = public_path($picture->getPathImage());
			\File::Delete($filename);
			$filename = public_path($picture->getPathThumbImage());
			\File::Delete($filename);
		}
	}
}