<?php

class UserNeighbors extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'users';
	// Don't forget to fill this array
	protected $fillable = array('id','status_id','email', 'password','confirmation_code','remember_token','confirmed');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	
     public function AssigmentRole()
    {
        return $this->hasMany('AssigmentRole');
    }
    
     public function Neighbors()
    {
        return $this->hasMany('Neighbors');
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
