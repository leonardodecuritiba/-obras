<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('client_id');
	        $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
	        $table->unsignedInteger('address_id');
	        $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
	        $table->string('name', 20);
	        $table->string('descriptions', 100);
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
        Schema::dropIfExists('units');
    }
}
