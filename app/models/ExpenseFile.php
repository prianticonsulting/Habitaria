<?php

class ExpenseFile extends \Eloquent {

	// Add your validation rules here

	protected $table = 'expenses_files';
	// Don't forget to fill this array
	protected $fillable = array('id','expense_id','public_filename','filename','item');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

    public function Expense()
    {
        return $this->belongsTo('Expense', 'expense_id');
    }
    
}
