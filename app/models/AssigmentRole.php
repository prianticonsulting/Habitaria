<?php

class AssigmentRole extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'assigned_roles';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','role_id','colony_id');
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
