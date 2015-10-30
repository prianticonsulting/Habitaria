<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class UserHab extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;
    
	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
     public function AssigmentRoleHab()
    {
        return $this->hasMany('AssigmentRole');
    }
	
      public function Neighbors()
    {
        return $this->hasOne('Neighbors');
    }   
    
}
