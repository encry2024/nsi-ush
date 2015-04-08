<?php
class AddUserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert(
			array(
				array( 
						'username' => 'maribel',
						'password' => Hash::make('maribel123'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					),
				array( 
						'username' => 'ron',
						'password' => Hash::make('ron123'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					)
			)
		);
    }

}