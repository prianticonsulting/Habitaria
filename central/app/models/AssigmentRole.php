<?php

class AssigmentRole extends \Eloquent {

	// Add your validation rules here

	//conexion a la BD
	protected $connection = 'central_dev';

	protected $table = 'assigned_roles';
	// Don't forget to fill this array
	protected $fillable = array('id','role_id','user_id');
	protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	 public function Role()
    {
        return $this->belongsto('Role', 'role_id');
    }

	 public function User()
    {
        return $this->belongsto('User', 'user_id');
    }
	
   
}
