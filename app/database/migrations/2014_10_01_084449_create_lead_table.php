<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads', function($table){
			$table->increments('id');
			$table->integer('vici_lead_id');
			$table->integer('vici_list_id');
			$table->dateTime('vici_sale_date');
			$table->string('vici_state');
			$table->string('vici_status');
			$table->string('submitted')->default('N');
			$table->dateTime('submit_date')->nullable();
			$table->string('success')->default('N');
			$table->dateTime('success_date')->nullable();
			$table->string('status')->nullable();
			$table->string('firstName')->nullable();
			$table->string('lastName')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('county')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('email')->nullable();
			$table->string('homephone')->nullable();
			$table->string('workphone')->nullable();
			$table->string('preferredcontacttime')->nullable();
			$table->string('birthdate')->nullable();
			$table->string('tobaccouser')->nullable();
			$table->string('pregnant')->nullable();
			$table->string('majorhealthproblems')->nullable();
			$table->string('currentcarrier')->nullable();
			$table->string('comments', 1000)->nullable();
			$table->string('AgentNumber')->default('5CECD075-3A70-4AEF-93C0-E011A5AB9445');
			$table->string('Password')->default('555%23*09192014NS10231420%21841');
			$table->string('Vendor')->default('NS');
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
		Schema::drop('leads');
	}

}
