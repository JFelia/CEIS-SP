<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
    	'name',
    	'contact_no',
    	'client_id',
        'client_code'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function messageclient(){
        return $this->hasMany('App\MessageClient');
    }
}
