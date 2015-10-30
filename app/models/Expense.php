<?php

class Expense extends \Eloquent {

	// Add your validation rules here

	protected $table = 'expenses';
	// Don't forget to fill this array
	protected $fillable = array('id','urbanism_id','sub_account_id','amount','created_by');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

    public function User()
    {
        return $this->belongsTo('User', 'created_by');
    }
    public function SubAccount()
    {
        return $this->belongsTo('SubAccount', 'sub_account_id');
    }
    
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }
    
    public function ExpenseFile()
    {
        return $this->hasMany('ExpenseFile');
    }
   
}
