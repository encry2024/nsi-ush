<?php
class UsernameSeeder extends Seeder {

    public function run()
    {
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

}