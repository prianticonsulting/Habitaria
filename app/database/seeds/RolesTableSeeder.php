<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();


        $roles = array(
            array(
                
                'name'		=> 'superadmin',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'name'		=> 'admin',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'name'		=> 'presidente',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'cobrador',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'comprador',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'vecino',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            )
        );

        DB::table('roles')->insert( $roles );
    }

}
