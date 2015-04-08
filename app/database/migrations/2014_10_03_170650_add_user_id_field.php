<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('leads', function($table){
			$table->integer('user_id');
		});

		Schema::table('links', function($table){
			$table->integer('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('leads', function($table){
			$table->dropColumn('user_id');
		});

		Schema::table('links', function($table){
			$table->dropColumn('user_id');
		});
	}

}
