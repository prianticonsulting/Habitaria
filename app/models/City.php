<?php

class City extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    protected $fillable = array('id', 'state_id', 'name');
    public $timestamps = false;

    public function State()
    {
        return $this->belongsTo('State', 'state_id');
    }

	 public function Colony()
    {
        return $this->hasMany('Colony');
    }
}
