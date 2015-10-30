<?php


class Country extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';
    public $timestamps = false;
	
	public function State()
    {
        return $this->hasMany('State');
    }
}


