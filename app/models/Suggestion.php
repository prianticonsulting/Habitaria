<?php

class Suggestion extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suggestions';
    protected $fillable = array('id', 'user_id', 'bd_inbox', 'asunto','contenido','tray','status','id_mesaje','id_receptor');
    public $timestamps = false;
}