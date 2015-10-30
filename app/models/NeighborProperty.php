<?php

class NeighborProperty extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'neighbors_properties';
	// Don't forget to fill this array
	protected $fillable = array('id','neighbors_id', 'urbanism_id', 'num_street_id','num_floor_id','num_house_or_apartment','status');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	 public function Neighbors()
    {
        return $this->belongsTo('Neighbors', 'neighbors_id');
    }
	
	 public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
	 public function Street()
    {
        return $this->belongsTo('StreetCatalog', 'num_street_id');
    }
	
	 public function Building()
    {
        return $this->belongsTo('BuildingCatalog', 'num_floor_id');
    }
 
	public function Payment()
    {
        return $this->hasMany('Payment');
    }
	
	public function PaymentStates()
    {
        return $this->hasMany('PaymentStates');
    }
   
}
