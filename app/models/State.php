<?php


class State extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    protected $fillable = array('id', 'country_id', 'name');
	public $timestamps = false;

    public function Country()
    {

        return $this->belongsTo('Country', 'country_id');
        
    }

    public function City()
    {

        return $this->hasMany('City');
    }
}


