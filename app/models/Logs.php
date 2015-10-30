<?php

class Logs extends \Eloquent {
	// Add your validation rules here

	protected $table = 'logs';
	// Don't forget to fill this array
	protected $fillable = ['user','urbanism_id','rol_user','user_email','accion','status','fecha'];
	public $timestamps = false;	
 
	public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }	 
}