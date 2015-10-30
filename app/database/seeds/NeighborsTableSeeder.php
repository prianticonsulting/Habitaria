<?php

class NeighborsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('neighbors')->delete();


        $neighbors = array(
            array(
                'name'		=> 'Super',
                'last_name'	=> 'Administrador',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 1,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'Administrador',
                'last_name'	=> 'Admin',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 2,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'Jhon',
                'last_name'	=> 'Presidente',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 3,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'Jhon',
                'last_name'	=> 'Cobrador',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 4,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'name'		=> 'Jhon',
                'last_name'	=> 'Comprador',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 5,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
				'name'		=> 'Jhon',
                'last_name'	=> 'Vecino',
                'phone'=> null,
                'mobile'=> null,
                'coments'=> null,
                'user_id'	=> 6,
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
               
            )
        );

        DB::table('neighbors')->insert( $neighbors );
    }

}
