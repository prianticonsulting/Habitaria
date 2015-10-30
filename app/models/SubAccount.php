<?php

class SubAccount extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'sub_accounts';
	// Don't forget to fill this array
	protected $fillable = array('id','account_id','urbanism_id', 'description');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	public function Account()
    {
        return $this->belongsTo('Account', 'account_id');
    }
	
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
    
    
    
}
