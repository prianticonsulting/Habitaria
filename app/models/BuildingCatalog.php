<?php

class BuildingCatalog extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'buildings_catalog';
	// Don't forget to fill this array
	protected $fillable = array('id','	urbanism_id', 'description');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	

	
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
    
}
