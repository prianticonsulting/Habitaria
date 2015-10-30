<?php

class UrbanismType extends \Eloquent {

	// Add your validation rules here

	protected $table = 'urbanism_types';
	// Don't forget to fill this array
	protected $fillable = array('id','type');
	 protected $primaryKey = 'id';
	
	protected $timestamp = false;

     
   
}
