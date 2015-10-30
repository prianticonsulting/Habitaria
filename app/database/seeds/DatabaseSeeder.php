<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		 $this->call('StatusTableSeeder');
		 $this->call('UsersTableSeeder');
		 $this->call('RolesTableSeeder');
		 $this->call('AssignedRoleTableSeeder');
		 $this->call('NeighborsTableSeeder');
		  $this->call('ColonyTypesTableSeeder');
		 $this->call('PropertyTypesTableSeeder');
		 $this->call('AccountTableSeeder');
		 $this->call('SubAccountTableSeeder');
		
	}

}
