<?php

class License extends \Eloquent {

	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
	// Add your validation rules here

	protected $table = 'license';
	// Don't forget to fill this array
	protected $fillable = array('id','months','code','colony_id');
	protected $primaryKey = 'id';

     public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }
	
}
