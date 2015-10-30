<?php

class Notifications extends \Eloquent {
	// protected $fillable = [];

	public function Notificacion()
    {
        return $this->belongsTo('State', 'state_id');
    }
}