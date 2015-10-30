<?php

class AssignedRoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('assigned_roles')->delete();


        $assigned_roles = array(
            array(
                
                'user_id'	=> 1,
                'role_id'	=> 1,
            ),
            array(
                
                'user_id'	=> 2,
                'role_id'	=> 2,
            ),
            array(
                
                'user_id'	=> 3,
                'role_id'	=> 3,
            ),
            array(
                
                'user_id'	=> 4,
                'role_id'	=> 4,
            ),
            array(
                
                'user_id'	=> 5,
                'role_id'	=> 5,
            ),
            array(
                
                'user_id'	=> 6,
                'role_id'	=> 6,
            )
        );

        DB::table('assigned_roles')->insert( $assigned_roles );
    }

}
