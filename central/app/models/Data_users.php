<?php

class Data_users extends \Eloquent {

	// Add your validation rules here

	//conexion a la BD
	protected $connection = 'central_dev';

	protected $table = 'data_users';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','name','last_name');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	
	public function User()
    {
        return $this->belongsTo('User', 'user_id');
    }
	

}
