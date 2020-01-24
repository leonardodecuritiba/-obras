<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//php artisan db:seed --class=BrandsTableSeeder
		$start = microtime(true);
		$filename = 'brands.csv';
		$this->command->info( "*** Iniciando o Upload (" . $filename . ") ***" );

		$file = storage_path( 'import' . DIRECTORY_SEPARATOR . $filename );
		$this->command->info( "*** Upload completo em " . round( ( microtime( true ) - $start ), 3 ) . "s ***" );

		$rows = Excel::load( $file, function ( $reader ) {
			$reader->toArray();
			$reader->noHeading();
		} )->get();

		foreach ( $rows as $row ) {
			$data = [
				'name'       => $row[0]
			];
			\App\Models\Commons\Brand::create( $data );
//		    $this->command->info( '****************** ('.$data['id'].') ******************' );
		}

	}
}
