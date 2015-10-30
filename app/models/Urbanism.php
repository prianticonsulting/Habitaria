<?php

class Urbanism extends \Eloquent {

	// Add your validation rules here

	protected $table = 'urbanisms';
	// Don't forget to fill this array
	protected $fillable = array('id','colony_id','urbanism_type_id','name');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     
	  public function Colony()
    {
        return $this->belongsTo('Colony', 'colony_id');
    }
    
     public function UrbanismType()
    {
        return $this->belongsTo('UrbanismType', 'urbanism_type_id');
    }
	
	public function BuildingCatalog()
    {
        return $this->hasMany('BuildingCatalog');
    }

	public function StreetCatalog()
    {
        return $this->hasMany('StreetCatalog');
    }
	
	public function AdminColonies()
    {
        return $this->hasMany('AdminColonies');
    }
	
	public function Neighbors()
    {
        return $this->hasMany('Neighbors');
    }
	
	public function Logs()
    {
        return $this->hasMany('Logs');
    }
}
