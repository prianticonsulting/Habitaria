<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
                
                'status_id'	=> 1,
                'email'		=> 'superadmin@ejemplo.org',
                'password'	=> Hash::make('superadmin'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'status_id'	=> 1,
                'email'		=> 'admin@ejemplo.org',
                'password'	=> Hash::make('administrador'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'status_id'	=> 1,
                'email'		=> 'presidente@ejemplo.org',
                'password'	=> Hash::make('presidente'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'status_id'	=> 1,
                'email'		=> 'cobrador@ejemplo.org',
                'password'	=> Hash::make('cobrador'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'status_id'	=> 1,
                'email'		=> 'comprador@ejemplo.org',
                'password'	=> Hash::make('comprador'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
            array(
                'status_id'	=> 1,
                'email'		=> 'vecino@ejemplo.org',
                'password'	=> Hash::make('vecino'),
                'confirmed'	=> 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at'=> new DateTime,
                'updated_at'=> new DateTime,
            ),
        );

        DB::table('users')->insert( $users );
    }

}
