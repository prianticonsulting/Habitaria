<?php

class Colony extends \Eloquent {

	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
	// Add your validation rules here

	protected $table = 'colonies';
	// Don't forget to fill this array
	protected $fillable = array('id','location_id','name');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     public function City()
    {
        return $this->belongsTo('City', 'location_id');
    }
	
    public function Promo()
    {
        return $this->hasMany('Promo');
    }
	 
	 public function Expiration()
    {
        return $this->hasMany('Expiration');
    }
	 
	 public function Urbanism()
    {
        return $this->hasMany('Urbanism');
    }
}
