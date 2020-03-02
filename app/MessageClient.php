<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageClient extends Model
{
    //
     protected $fillable = [
    	'client_id', //to get the client name
    	'contact_id', //to get the contact numbers
    	'message_id', //to get the message
    	'user_id', //to get the sender
        'type', //for identification, all type 1 is to be send and update to type 2 if successfully sent
        'status', //for identification of outbound and trash messages
        'month_year',
        'identifier'
    ];

    public function contact(){
    	return $this->belongsTo('App\Contact');
    }
    public function message(){
    	return $this->belongsTo('App\Message');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
