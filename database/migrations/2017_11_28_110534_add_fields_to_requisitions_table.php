<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisitions', function (Blueprint $table) {            //
	        $table->string('reason', 500)->nullable();
	        $table->string('address', 100)->nullable();
	        $table->string('contact', 100)->nullable();
	        $table->string('phone', 20)->nullable();
	        $table->string('hour', 5)->nullable();
	        $table->string('observations', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            //
        });
    }
}
