<?php

use Illuminate\Database\Seeder;

class BeginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //php artisan db:seed --class=BeginSeeder
	    $start = microtime(true);

	    DB::unprepared( DB::raw( file_get_contents( storage_path( 'import' ) . DIRECTORY_SEPARATOR . 'metric_units.sql' ) ) );
	    $this->command->info( 'metric_units complete ...' );

	    $this->call(BrandsTableSeeder::class);
	    $this->command->info( 'Brands complete ...' );

	    $this->call(GroupsTableSeed::class);
	    $this->command->info( 'Groups complete ...' );

	    $this->call(SubGroupsTableSeed::class);
	    $this->command->info( 'SubGroups complete ...' );

	    $this->call(PlightsTableSeed::class);
	    $this->command->info( 'Plights complete ...' );

	    $this->call(CepTablesSeed::class);
	    $this->command->info( 'CepTablesSeed complete ...' );


//	    DB::unprepared( DB::raw( file_get_contents( storage_path( 'import' ) . DIRECTORY_SEPARATOR . 'obras.sql' ) ) );
//	    $this->command->info( 'obras complete ...' );


	    $this->command->info( "*** BeginSeeder realizada com sucesso em " . round( ( microtime( true ) - $start ), 3 ) . "s ***" );

    }
}
