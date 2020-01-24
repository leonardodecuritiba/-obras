<?php

namespace App\Providers;

use App\Models\Clients\Client;
use App\Models\Clients\Unit;
use App\Models\Commons\Group;
use App\Models\Commons\Picture;
use App\Models\Commons\Product;
use App\Models\Requisitions\Requisition;
use App\Models\Requisitions\RequisitionBudget;
use App\Models\Suppliers\Supplier;
use App\Models\Users\Collaborator;
use App\Observers\Clients\ClientObserver;
use App\Observers\Commons\PictureObserver;
use App\Observers\Commons\ProductObserver;
use App\Observers\Requisitions\RequisitionBudgetObserver;
use App\Observers\Requisitions\RequisitionObserver;
use App\Observers\Suppliers\SupplierObserver;
use App\Observers\Clients\UnitObserver;
use App\Observers\Commons\GroupObserver;
use App\Observers\Users\CollaboratorObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Zizaco\Entrust\MigrationCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength( 191 );
	    Client::observe( ClientObserver::class );
	    Supplier::observe( SupplierObserver::class );
	    Unit::observe( UnitObserver::class );
	    Group::observe( GroupObserver::class );
	    Product::observe( ProductObserver::class );
	    Picture::observe( PictureObserver::class );
	    Requisition::observe( RequisitionObserver::class );
	    RequisitionBudget::observe( RequisitionBudgetObserver::class );
	    Collaborator::observe( CollaboratorObserver::class );
	    if(env('APP_ENV_PLACE') == 'locaweb'){
		    App::bind('path.public', function() {
			    $path = base_path();
			    $path = substr ( $path, 0, strlen($path) - strlen('sistema-laravel'));
			    return $path . 'sistema';
		    });
	    }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->singleton( FakerGenerator::class, function () {
		    return FakerFactory::create( 'pt_BR' );
	    } );
	    $this->app->extend('command.entrust.migration', function () {
		    return new class extends MigrationCommand
		    {
			    public function handle()
			    {
				    parent::fire();
			    }
		    };
	    });
    }
}
