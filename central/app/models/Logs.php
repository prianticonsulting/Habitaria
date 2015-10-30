<?php

class Logs extends \Eloquent {
	
	//conexion a la BD
	protected $connection = 'habitaria_dev';

	protected $table = 'logs';
	// Don't forget to fill this array
	protected $fillable = ['user','urbanism_id','rol_user','accion','status','fecha'];
	public $timestamps = false;	

	
	public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }	
}