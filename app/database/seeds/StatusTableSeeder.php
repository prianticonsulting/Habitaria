<?php

class StatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('status')->delete();


        $status = array(
            array(
                
                'type'		=> 'Activo',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'type'		=> 'Suspendido',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'type'		=> 'Prohibido',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            )
        );

        DB::table('status')->insert( $status );
    }

}
