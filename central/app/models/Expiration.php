<?php

class Expiration extends \Eloquent {

	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
	// Add your validation rules here

	protected $table = 'expiration';
	// Don't forget to fill this array
	protected $fillable = array('id','colony_id','expiration','status');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }

}
