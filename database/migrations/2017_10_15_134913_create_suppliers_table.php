<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('contact_id');
	        $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
	        $table->unsignedInteger('address_id');
	        $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

	        $table->string('cnpj', 60)->nullable();
	        $table->string('ie', 60)->nullable();
	        $table->boolean('isention_ie')->default(0);
	        $table->string('company_name', 100)->nullable();
	        $table->string('fantasy_name', 100)->nullable();
	        $table->date('foundation')->nullable();

	        $table->string('favored_cnpj', 60)->nullable();
	        $table->string('favored_cpf', 20)->nullable();
	        $table->string('favored_name', 100)->nullable();
	        $table->string('bank', 100)->nullable();
	        $table->string('agency', 10)->nullable();
	        $table->string('account', 10)->nullable();

	        $table->timestamps();
	        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
