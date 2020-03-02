<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
     protected $fillable = [
    	'user_id', //to get the sender name
    	'email_id', //to get the parent email
        'client_id',
        'message', 
        'status'
    ];

    public function email(){
    	return $this->belongsTo('App\Email');
    }
}
