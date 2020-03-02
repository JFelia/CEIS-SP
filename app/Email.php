<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //
     protected $fillable = [
    	'client_id', //to get the client name
        'recipients',
    	'message', //message of the client
        'status' //for identification of outbound and trash messages
    ];

    public function email(){
    	return $this->belongsTo('App\User');
    }

    public function reply(){
    	return $this->hasMany('App\Reply');
    }
}
