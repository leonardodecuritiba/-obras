<?php

use Illuminate\Database\Seeder;
use \App\Models\Clients\Client;
use \App\Models\Clients\Unit;
use \App\Models\Users\Collaborator;
use \App\Models\Suppliers\Supplier;
use App\Models\Requisitions\Requisition;
use \App\Models\Commons\Product;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //php artisan db:seed --class=TestSeeder
	    Client::flushEventListeners();
	    Client::getEventDispatcher();
	    Unit::flushEventListeners();
	    Unit::getEventDispatcher();
	    Supplier::flushEventListeners();
	    Supplier::getEventDispatcher();

	    $start = microtime(true);

	    factory( Client::class, 'legal', 20 )->create();
	    $this->command->info( 'Client-legal complete ...' );

	    factory( Client::class, 'natural', 1 )->create();
	    $this->command->info( 'Client-natural complete ...' );

	    factory( Client::class, 'legal', 4 )->create();
	    $this->command->info( 'Client-legal complete ...' );

	    factory( \App\Models\Clients\Unit::class, 50 )->create();
	    for($i=1; $i<=20; $i++){
	    	$Unit = \App\Models\Clients\Unit::find($i);
		    $Unit->update(['client_id'=>$i]);
	    }
	    $this->command->info( 'Unit complete ...' );

	    factory( \App\Models\Clients\Job::class, 50
	    )->create();
	    $this->command->info( 'Job complete ...' );

	    factory( Supplier::class, 20 )->create();
	    $this->command->info( 'Supplier complete ...' );

	    factory( Product::class, 100 )->create();
	    $this->command->info( 'Product complete ...' );

	    factory( Requisition::class, 25 )->create();
	    $this->command->info( 'Requisition complete ...' );


	    $this->command->info( "*** Importacao IMPORTSEEDER realizada com sucesso em " . round( ( microtime( true ) - $start ), 3 ) . "s ***" );

    }
}
