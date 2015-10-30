<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;
    

	
     public function AssigmentRole()
    {
        return $this->hasMany('AssigmentRole');
    }
    
     public function Neighbors()
    {
        return $this->hasOne('Neighbors');
    }
	
     public function Collector()
    {
        return $this->hasMany('Collector');
    }
    
     public function Status()
    {
        return $this->belongsto('Status', 'status_id');
    }
    
    
}
