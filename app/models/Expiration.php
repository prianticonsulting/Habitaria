<?php

class Expiration extends \Eloquent {

	// Add your validation rules here

	protected $table = 'expiration';
	// Don't forget to fill this array
	protected $fillable = array('id','colony_id','expiration');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }

}
