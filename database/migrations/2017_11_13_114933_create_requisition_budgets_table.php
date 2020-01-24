<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_budgets', function (Blueprint $table) {
            $table->increments('id');

	        $table->unsignedInteger('requisition_id');
	        $table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
	        $table->unsignedInteger('product_id');
	        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
	        $table->unsignedInteger('brand_id')->nullable();
	        $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

	        $table->decimal('quantity',20,2);
	        $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_budgets');
    }
}
