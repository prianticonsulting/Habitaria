<?php

class Neighbors extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'neighbors';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','name','last_name','phone','mobile','coments');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	
	public function UserNeighbors()
    {
        return $this->belongsTo('User', 'user_id');
    }
	
	public function User()
    {
        return $this->belongsTo('User', 'user_id');
    }
	
	public function NeighborProperty()
    {
        return $this->hasMany('NeighborProperty');
    }
   
	 public function AssigmentRole()
    {
        return $this->belongsto('AssigmentRole', 'user_id');
    }
}
