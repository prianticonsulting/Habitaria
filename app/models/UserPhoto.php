<?php

class UserPhoto extends \Eloquent {

	// Add your validation rules here

	protected $table = 'user_photo';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','public_filename','filename','colony_id');
	// protected $primaryKey = 'id';
	
	//protected $timestamp = false;

    public function User()
    {
        return $this->belongsTo('User', 'created_by');
    }
    
   
}
