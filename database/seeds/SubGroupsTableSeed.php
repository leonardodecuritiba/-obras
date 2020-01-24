<?php

use Illuminate\Database\Seeder;

class SubGroupsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	//php artisan db:seed --class=SubGroupsTableSeed
	    $start = microtime(true);
	    $filename = 'subgroups.csv';
	    $this->command->info( "*** Iniciando o Upload (" . $filename . ") ***" );

	    $file = storage_path( 'import' . DIRECTORY_SEPARATOR . $filename );
	    $this->command->info( "*** Upload completo em " . round( ( microtime( true ) - $start ), 3 ) . "s ***" );

	    $rows = Excel::load( $file, function ( $reader ) {
		    $reader->toArray();
		    $reader->noHeading();
	    } )->get();

	    foreach ( $rows as $row ) {
	    	$group = \App\Models\Commons\Group::where('name',$row[1])->first();
	    	if($group == NULL){
			    $group = \App\Models\Commons\Group::create(['name' => $row[1]]);
		    }
		    $data = [
			    'group_id'  => $group->id,
			    'name'      => $row[0]
		    ];
		    \App\Models\Commons\SubGroup::create( $data );
//		    $this->command->info( '****************** ('.$data['id'].') ******************' );
	    }
    }
}
