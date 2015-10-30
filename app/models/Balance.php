<?php

class Balance extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'balances';
    protected $fillable = array('id','collector_id', 'neighbor_property_id', 'amount', 'coments' );
	protected $primaryKey = 'id';
	
    public $timestamps = false;
    
     public function Collector()
    {
        return $this->belongsTo('Collector', 'collector_id');
    }
    
    public function NeighborProperty()
    {
        return $this->belongsTo('NeighborProperty', 'neighbor_property_id');
    }


}
