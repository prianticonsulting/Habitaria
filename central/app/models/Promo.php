<?php

class Promo extends \Eloquent {

	//conexion a la BD
	protected $connection = 'habitaria_dev';
	
	// Add your validation rules here

	protected $table = 'promo_code';
	// Don't forget to fill this array
	protected $fillable = array('id','days','code','status','colony_id');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }
	
}
