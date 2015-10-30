<?php

class StreetCatalog extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'streets_catalog';
	// Don't forget to fill this array
	protected $fillable = array('id','urbanism_id', 'name');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	

	
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
    
}
