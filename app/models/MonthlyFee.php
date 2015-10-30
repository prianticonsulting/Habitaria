<?php

class MonthlyFee extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'monthly_fee';
    protected $fillable = array('id','urbanism_id', 'amount', 'since', 'until');
    public $timestamps = false;
    
    public function Urbanism()
    {
        return $this->belongsTo('Urbanism', 'urbanism_id');
    }


}
