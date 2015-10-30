<?php

use Zizaco\Entrust\EntrustRole;
//EntrustRole
class RoleHab extends Eloquent
{
	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
	protected $table = "roles";
	protected $fillable = array('id','name');
	protected $primaryKey = 'id';
	
	public function AssigmentRoleHab()
    {
        return $this->hasOne('AssigmentRoleHab');
    } 
}
