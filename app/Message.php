<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
    	'message'
    ];

    public function messageclient(){
    	return $this->hasMany('App\MessageClient');
    }
}
