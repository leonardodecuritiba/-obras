<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterQuantityToRequisitionBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisition_budgets', function (Blueprint $table) {
	        $table->decimal('quantity',10,2)->change();
        });
        Schema::table('requisition_buys', function (Blueprint $table) {
	        $table->decimal('quantity',10,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisition_budgets', function (Blueprint $table) {
            //
        });
    }
}
