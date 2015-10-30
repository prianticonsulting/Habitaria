<?php

class PropertyTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('property_types')->delete();


        $property_types = array(
            array(
                
                'type'		=> 'Colonia Abierta',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'type'		=> 'Colonia Cerrada',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                
                'type'		=> 'Edificio',
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            )
        );

        DB::table('property_types')->insert( $property_types );
    }

}
