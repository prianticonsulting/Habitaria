<?php

class AssigmentRoleHab extends \Eloquent {

	// Add your validation rules here

	//conexion a la BD
	protected $connection = 'habitaria_dev';

	protected $table = 'assigned_roles';
	// Don't forget to fill this array
	protected $fillable = array('id','role_id','user_id','colony_id');
	protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	 public function RoleHab()
    {
        return $this->belongsto('RoleHab', 'role_id');
    }

	 public function UserHab()
    {
        return $this->belongsto('UserHab', 'user_id');
    }
	
   
}
