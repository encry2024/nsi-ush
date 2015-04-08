<?php
class AddAnotherUserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert(
			array(
				array( 
						'username' => 'winston',
						'password' => Hash::make('winston123'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					)
			)
		);
    }

}