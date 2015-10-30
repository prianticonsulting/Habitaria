<?php

class Neighbors extends \Eloquent {

	//conexion a la BD
	protected $connection = 'habitaria_dev';


	protected $table = 'neighbors';
	// Don't forget to fill this array
	protected $fillable = array('id','user_id','name','last_name','phone','mobile','coments');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	public function UserHab()
    {
        return $this->belongsTo('UserHab', 'user_id');
    }
	
	public function NeighborProperty()
    {
        return $this->hasMany('NeighborProperty');
    }
   
	 public function AssigmentRoleHab()
    {
        return $this->belongsto('AssigmentRoleHab', 'user_id');
    }
}
