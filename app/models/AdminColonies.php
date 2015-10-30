<?php

class AdminColonies extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_admins';
    protected $fillable = array('id', 'user_id', 'urbanism_id');
  
    protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	public function User()
    {
        return $this->belongsTo('User', 'user_id');
    }

	public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
	
	public function InvitedNeighbors()
    {
        return $this->hasMany('InvitedNeighbors');
    }
}
