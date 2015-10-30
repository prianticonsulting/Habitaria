<?php

class PaymentStatus extends \Eloquent {

	protected $table = 'payment_status';
	protected $fillable = array('id','status');
	protected $primaryKey = 'id';
	
	protected $timestamp = false;
	
	 public function Payment()
    {
        return $this->hasMany('Payment');
    }
	
   
}
