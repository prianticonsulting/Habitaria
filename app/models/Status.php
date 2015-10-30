<?php

class Status extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'status';
	// Don't forget to fill this array
	protected $fillable = array('id','type');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	

	 public function User()
    {
        return $this->hasMany('User');
    }
	
   
}
