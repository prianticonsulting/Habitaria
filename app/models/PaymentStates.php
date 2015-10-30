<?php

class PaymentStates extends \Eloquent {


	protected $table = 'payment_states';
	protected $fillable = array('id','neighbor_property_id','year','jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','decem','accumulated');
	protected $primaryKey = 'id';
	
	protected $timestamp = false;


	 public function NeighborProperty()
    {
        return $this->belongsTo('NeighborProperty', 'neighbor_property_id');
    }	
	
	
   
}
