<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
     protected $fillable = [
     	'post_id',
        'user_id',
    	'commentor', //to get the sender name
        'avatar',
        'message',
        'client'
    ];

    public function posts(){
    	return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
