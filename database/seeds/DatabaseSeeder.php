<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    set_time_limit( 3600 );
	    $this->call(BeginSeeder::class);

	    $destinationPath = public_path(
		    'uploads'
	    );
	    \File::deleteDirectory($destinationPath);
	    \File::makeDirectory($destinationPath, $mode = 0777, true, true);

	    $destinationPath = $destinationPath . DIRECTORY_SEPARATOR  . 'products';
	    \File::makeDirectory($destinationPath, $mode = 0777, true, true);
    }
}
