<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;
    
	//conexion a la BD
	protected $connection = 'central_dev';
	
     public function AssigmentRole()
    {
        return $this->hasMany('AssigmentRole');
    }
    
     public function Data_users()
    {
        return $this->hasOne('Data_users');
    }
	
    
}
