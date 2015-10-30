<?php

use Zizaco\Entrust\EntrustRole;
//EntrustRole
class Role extends Eloquent
{
	protected $table = "roles";
	protected $fillable = array('id','name');
	protected $primaryKey = 'id';
	
	public function AssigmentRole()
    {
        return $this->hasOne('AssigmentRole');
    } 
}
