<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ImportCompleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //php artisan db:seed --class=ImportCompleteSeeder
	    $start = microtime(true);
	    $filename = 'obras.sql';
	    $this->command->info( "*** Iniciando o Upload (" . $filename . ") ***" );
	    DB::unprepared( DB::raw( file_get_contents( storage_path( 'import' ) . DIRECTORY_SEPARATOR . $filename ) ) );
	    $this->command->info( "Completo em " . round((microtime(true) - $start), 3) . "s) ***" );
    }
}
