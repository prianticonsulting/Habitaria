<?php

class Payment extends \Eloquent {

	protected $table = 'payments';
	protected $fillable = array('id','neighbor_property_id','collector_id', 'amount', 'sub_account_id', 'coments', 'deposit', 'debt', 'status_id');
	protected $primaryKey = 'id';
	
	protected $timestamp = false;
		

	 public function Collector()
    {
        return $this->belongsTo('Collector', 'collector_id');
    }
	
	 public function SubAccount()
    {
        return $this->belongsTo('SubAccount', 'sub_account_id');
    }
    
    public function NeighborProperty()
    {
        return $this->belongsTo('NeighborProperty', 'neighbor_property_id');
    }	
	
    public function PaymentStatus()
    {
        return $this->belongsTo('PaymentStatus', 'status_id');
    }		
	
   
}
