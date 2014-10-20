<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->timestamps();
		});

		DB::table('users')->insert(
			array(
				array( 
						'username' => 'admin',
						'password' => Hash::make('admin'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					),
				array( 
						'username' => 'angel',
						'password' => Hash::make('angel123'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					),
				array( 
						'username' => 'van',
						'password' => Hash::make('van123'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					)
			)
		);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
