<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
	        $table->increments('id');

	        $table->unsignedInteger('author_id')->nullable();
	        $table->foreign('author_id')->references('id')->on('collaborators')->onDelete('cascade');

	        $table->unsignedInteger('buyer_id')->nullable();
	        $table->foreign('buyer_id')->references('id')->on('collaborators')->onDelete('cascade');

	        $table->unsignedInteger('approver_id')->nullable();
	        $table->foreign('approver_id')->references('id')->on('collaborators')->onDelete('cascade');

	        $table->unsignedInteger('job_id');
	        $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
	        $table->unsignedInteger('group_id');
	        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
	        $table->unsignedInteger('subgroup_id');
	        $table->foreign('subgroup_id')->references('id')->on('sub_groups')->onDelete('cascade');

	        $table->unsignedInteger('plight_id');
	        $table->foreign('plight_id')->references('id')->on('plights')->onDelete('cascade');

	        $table->unsignedInteger('status_id');

	        $table->date('due')->nullable();
	        $table->unsignedInteger('doc_type')->nullable();
	        $table->unsignedInteger('parcelas')->nullable();

	        $table->dateTime('closed_at')->nullable();
	        $table->dateTime('cotation_closed_at')->nullable();
	        $table->dateTime('approved_at')->nullable();
	        $table->dateTime('request_at')->nullable();
	        $table->dateTime('buy_at')->nullable();
	        $table->dateTime('delivered_at')->nullable();
	        $table->dateTime('due_at')->nullable();

	        $table->string('document_number',50)->nullable();
	        $table->string('main_descriptions',500);

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
        Schema::dropIfExists('requisitions');

    }
}
