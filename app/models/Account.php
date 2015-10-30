<?php

class Account extends \Eloquent {

	// Add your validation rules here

	

	protected $table = 'accounts';
	// Don't forget to fill this array
	protected $fillable = array('id','description');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	
   
}
