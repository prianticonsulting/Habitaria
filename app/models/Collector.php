<?php

class Collector extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'collectors';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','urbanism_id');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	  public function User()
    {
        return $this->belongsTo('User', 'user_id');
    }

	  public function Neighbors()
    {
        return $this->belongsTo('Neighbors', 'user_id');
    }

	public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
	
	
	
	
   
}
