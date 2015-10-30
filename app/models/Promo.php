<?php

class Promo extends \Eloquent {

	// Add your validation rules here

	protected $table = 'promo_code';
	// Don't forget to fill this array
	protected $fillable = array('id','colony_id','code','days','status');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }

}
