<?php

class InvitedNeighbors extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'invited_neighbors';
	// Don't forget to fill this array
	protected $fillable = array('id','neighbor_id' ,'invited_id','urbanism_id', 'email','confirmed','confirmation_code');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	

	
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
    public function AdminColonies()
    {
        return $this->belongsTo('AdminColonies', 'neighbor_id');
    }
}
